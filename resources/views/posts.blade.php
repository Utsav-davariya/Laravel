<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel AJAX CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container mt-5">

    <!-- Create and Edit Form -->
    <form id="postForm">
        <input type="hidden" id="postId" name="postId">
        <div class="form-group row">
            <h5>Title</h5>
            <input type="text" id="title" name="title" class="form-control" placeholder="Title" required>
        </div>
        <div class="form-group row">
            <h5>Content</h5>
            <textarea id="content" name="content" class="form-control" placeholder="Content" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <!-- Posts Table -->
    <table class="table mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="postTable">
        @foreach($posts as $post)
            <tr id="post-{{ $post->id }}">
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>
                    <button class="btn btn-info btn-sm editPost" data-id="{{ $post->id }}">Edit</button>
                    <button class="btn btn-danger btn-sm deletePost" data-id="{{ $post->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        // CSRF Token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Create or Update Post
        $('#postForm').on('submit', function (e) {
            e.preventDefault();

            let postId = $('#postId').val();
            let title = $('#title').val();
            let content = $('#content').val();
            let url = postId ? `/posts/${postId}` : '/posts';

            $.ajax({
                url: url,
                type: postId ? 'PUT' : 'POST',
                data: {title: title, content: content},
                success: function (post) {
                    let postRow = `<tr id="post-${post.id}">
                        <td>${post.id}</td>
                        <td>${post.title}</td>
                        <td>${post.content}</td>
                        <td>
                            <button class="btn btn-info btn-sm editPost" data-id="${post.id}">Edit</button>
                            <button class="btn btn-danger btn-sm deletePost" data-id="${post.id}">Delete</button>
                        </td>
                    </tr>`;

                    if (postId) {
                        $(`#post-${postId}`).replaceWith(postRow);
                    } else {
                        $('#postTable').append(postRow);
                    }

                    $('#postForm')[0].reset();
                }
            });
        });

        // Edit Post
        $(document).on('click', '.editPost', function () {
            let postId = $(this).data('id');

            $.get(`/posts/${postId}`, function (post) {
                $('#postId').val(post.id);
                $('#title').val(post.title);
                $('#content').val(post.content);
            });
        });

        // Delete Post
        $(document).on('click', '.deletePost', function () {
            if (confirm('Are you sure you want to delete this post?')) {
                let postId = $(this).data('id');

                $.ajax({
                    url: `/posts/${postId}`,
                    type: 'DELETE',
                    success: function () {
                        $(`#post-${postId}`).remove();
                            $('#postForm')[0].reset();
                            $('#postId').val(''); 
                    }

                });
            }
        });
    });
</script>
</body>
</html>
