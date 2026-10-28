<x-mail::message>
A new admission enquiry has arrived.

**Parent:** {{ $enquiry->parent_name }}  
**Student:** {{ $enquiry->student_name }}  
**Class:** {{ $enquiry->class_applying_for }}  
**Mobile:** {{ $enquiry->mobile }}  
**Email:** {{ $enquiry->email ?: 'Not provided' }}  

{{ $enquiry->message ?: 'No message was added.' }}

<x-mail::button :url="url('/admin/enquiries')">
Review in admin
</x-mail::button>

Thanks,<br>
{{ config('school.name') }} website
</x-mail::message>
