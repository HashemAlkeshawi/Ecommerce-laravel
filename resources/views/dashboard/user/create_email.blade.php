@extends('mainTemplate')
@section('title')
<title>Add new user</title>
@endsection
@include('components\navBar')

@section('content')
<div style="margin-top: 20;" class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-12">
        <div class="page-header">
            <h1 class="header">Send Email for: {{$user_name}} </h1>
        </div>
        <form method="POST" action="{{ URL('/user/email') }}">
            @csrf
            <div class="form-check">
                <input type="radio" class="form-check-input" id="defaultType" name="type" value="0" checked>Default welcom email
                <label class="form-check-label" for="defaultType"></label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="customType" name="type" value="1">Create custom email
                <label class="form-check-label" for="customType"></label>
            </div>
            <input type="hidden" name="user_id" value="{{ $user_id }}">

            <div class="form-group">
                <label id="subjectLabel" class="form-label">Subject</label>
                <input class="form-control" type="text" name="subject" id="subject">
            </div>

            <div class="form-group">
                <label id="contentLabel">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <br><br>
            <button class="btn btn-primary" type="submit">Send</button>
        </form>
    </div>
</div>
<script>
    // Get the radio buttons and the input fields
    const defaultTypeRadio = document.getElementById('defaultType');
    const customTypeRadio = document.getElementById('customType');
    const subjectInput = document.getElementById('subject');
    const contentTextarea = document.getElementById('content');
    const subjectLabel = document.getElementById('subjectLabel');
    const contentLabel = document.getElementById('contentLabel');

    // Function to toggle input visibility
    function toggleInputs(type) {
        if (type === 'default') {
            subjectInput.style.display = 'none';
            contentTextarea.style.display = 'none';
            subjectLabel.style.display = 'none';
            contentLabel.style.display = 'none';
        } else if (type === 'custom') {
            subjectInput.style.display = 'block';
            contentTextarea.style.display = 'block';
            subjectLabel.style.display = 'block';
            contentLabel.style.display = 'block';
        }
    }

    // Initial setup based on the default value
    toggleInputs(defaultTypeRadio.checked ? 'default' : 'custom');

    // Add event listeners to toggle on radio button change
    defaultTypeRadio.addEventListener('change', () => toggleInputs('default'));
    customTypeRadio.addEventListener('change', () => toggleInputs('custom'));
</script>
@endsection