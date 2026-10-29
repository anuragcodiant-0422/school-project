<?php

namespace Tests\Feature;

use App\Models\AdmissionEnquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEnquiryListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_ajax_filter_and_pagination_return_only_matching_enquiries(): void
    {
        $this->actingAs(User::factory()->create());

        foreach (range(1, 14) as $number) {
            $this->createEnquiry([
                'parent_name' => 'Parent '.$number,
                'mobile' => str_pad((string) $number, 10, '0', STR_PAD_LEFT),
                'status' => $number === 14 ? 'contacted' : 'new',
            ]);
        }

        $firstPage = $this->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->get(route('admin.enquiries.index', ['status' => 'new']));

        $firstPage
            ->assertOk()
            ->assertSee('Parent 12')
            ->assertDontSee('Parent 1</strong>')
            ->assertDontSee('Parent 14')
            ->assertSee('page=2')
            ->assertSee('status=new')
            ->assertDontSee('id="enquiryListing"')
            ->assertDontSee('Admission enquiries');

        $secondPage = $this->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->get(route('admin.enquiries.index', ['status' => 'new', 'page' => 2]));

        $secondPage
            ->assertOk()
            ->assertSee('Parent 1')
            ->assertDontSee('Parent 14')
            ->assertSee('status=new');
    }

    public function test_regular_enquiry_page_keeps_filters_and_ajax_container(): void
    {
        $this->actingAs(User::factory()->create());
        $this->createEnquiry(['parent_name' => 'Example Parent']);

        $this->get(route('admin.enquiries.index'))
            ->assertOk()
            ->assertSee('id="enquiryFilters"', false)
            ->assertSee('id="enquiryListing"', false)
            ->assertSee('Example Parent');
    }

    public function test_enquiry_status_can_be_updated_with_ajax(): void
    {
        $this->actingAs(User::factory()->create());
        $enquiry = $this->createEnquiry();

        $this->patchJson(route('admin.enquiries.status', $enquiry), ['status' => 'contacted'])
            ->assertOk()
            ->assertJsonPath('status', 'contacted');

        $this->assertDatabaseHas('admission_enquiries', [
            'id' => $enquiry->id,
            'status' => 'contacted',
        ]);
    }

    private function createEnquiry(array $overrides = []): AdmissionEnquiry
    {
        static $counter = 0;
        $counter++;

        return AdmissionEnquiry::query()->create(array_merge([
            'parent_name' => 'Sample Parent',
            'student_name' => 'Sample Student',
            'class_applying_for' => 'Nursery',
            'mobile' => str_pad((string) $counter, 10, '0', STR_PAD_LEFT),
            'email' => 'parent'.$counter.'@example.com',
            'message' => 'Test enquiry',
            'status' => 'new',
            'crm_status' => 'pending',
        ], $overrides));
    }
}
