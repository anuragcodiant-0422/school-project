<?php

namespace Database\Seeders;

use App\Models\NewsEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsEventSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Annual Sports Day: Little Champions on the Field',
                'category' => 'Event',
                'item_date' => '2026-10-18',
                'image' => 'https://images.unsplash.com/photo-1471295253337-3ceaaedca402?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Our students celebrated teamwork, courage and joy at this year’s Sports Day on the Noida campus.',
                'content' => '<p>The grounds came alive with colour, music and cheering families as every class took part in age-appropriate races, relays and cooperative games.</p><p>Teachers designed stations that mixed movement with problem-solving, so children practised listening, turn-taking and resilience as much as running.</p><p>Medals were awarded for effort, sportsmanship and improvement. Photographs from the day are now up in the Event Diary.</p>',
            ],
            [
                'title' => 'Science Week Sparks Curious Minds',
                'category' => 'News',
                'item_date' => '2026-10-08',
                'image' => 'https://images.unsplash.com/photo-1588072432836-e10032774343?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Classrooms turned into mini labs as children explored magnets, plants, water and simple machines.',
                'content' => '<p>Science Week invited every learner to ask “what if?” through hands-on experiments rather than worksheets.</p><p>Nursery children mixed colours and observed floating objects. Older classes built marble runs and recorded predictions before testing them.</p><p>Parents joined a Friday showcase where students explained their favourite discovery in their own words.</p>',
            ],
            [
                'title' => 'Art Exhibition: Colours of Childhood',
                'category' => 'Achievement',
                'item_date' => '2026-09-26',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Original paintings, clay work and story collages from every grade filled the atrium this month.',
                'content' => '<p>The exhibition celebrated process over product. Each display card described the child’s idea, the materials used and what they enjoyed most.</p><p>Visitors walked through galleries themed around monsoon, friendship and “my neighbourhood”. Several artworks will travel to our partner community centre.</p>',
            ],
            [
                'title' => 'Founders’ Day Assembly & Community Picnic',
                'category' => 'Event',
                'item_date' => '2026-09-12',
                'image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Students, teachers and families gathered to honour the school’s founding story with song, food and outdoor play.',
                'content' => '<p>The morning assembly featured student-led storytelling about kindness and courage. In the afternoon, families shared a picnic on the lawns.</p><p>Alumni parents volunteered at craft stalls and a book swap. It was a reminder that Manthan is a community, not only a campus.</p>',
            ],
            [
                'title' => 'Reading Festival Opens a New Library Corner',
                'category' => 'News',
                'item_date' => '2026-08-29',
                'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'A week of read-alouds, author visits and quiet reading nooks launched our expanded early-years library.',
                'content' => '<p>Children voted on cushion colours, labelled shelves and practised borrowing books with picture cards.</p><p>Guest storytellers visited in Hindi and English. Families can now borrow weekend book bags from the front office.</p>',
            ],
            [
                'title' => 'Green Campus Award for Waste-Wise Classrooms',
                'category' => 'Achievement',
                'item_date' => '2026-08-14',
                'image' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Student eco-monitors helped the school earn a city recognition for composting and plastic-free snack days.',
                'content' => '<p>Each class tracks food waste and runs a small compost bin. UKG children named the worms; Class 4 graphed weekly totals.</p><p>The award belongs to the children who reminded all of us — including adults — to carry steel bottles and reusable tiffin boxes.</p>',
            ],
        ];

        foreach ($items as $item) {
            $slug = Str::slug($item['title']);

            NewsEvent::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    ...$item,
                    'slug' => $slug,
                    'is_published' => true,
                    'meta_title' => $item['title'].' | The Manthan School',
                    'meta_description' => $item['short_description'],
                ]
            );
        }
    }
}
