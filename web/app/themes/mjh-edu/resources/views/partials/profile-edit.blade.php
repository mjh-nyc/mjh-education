<h2>{!! __('Edit profile','sage') !!} </h2>
@if( !empty($updated))
    <p>{{ __('Profile updated', 'sage') }}</p>
@endif
<form method="post" class="users-edit">
    <input type="hidden" name="edit-profile" value="edit" />
    @php acf_form('edit-user') @endphp
</form>