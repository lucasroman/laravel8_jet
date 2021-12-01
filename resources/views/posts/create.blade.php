<a href="{{ route('dashboard') }}">Back</a>

<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <h1>Create a new post</h1>
    Title
    <input>
    Text
    <Textarea></Textarea>
    <input type=submit>
</form>


