function openModal(postId) {
    document.getElementById('postModal').style.display = "block";
    document.getElementById(postId).style.display = "block";
}

function closeModal() {
    document.getElementById('postModal').style.display = "none";
    var posts = document.getElementsByClassName('full-post');
    for (var i = 0; i < posts.length; i++) {
        posts[i].style.display = "none";
    }
}