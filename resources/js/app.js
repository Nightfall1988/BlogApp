import axios from 'axios';

import 'tailwindcss/tailwind.css'

    document.addEventListener('DOMContentLoaded', function() {
        const toggleCommentsBtn = document.getElementById('toggle-comments');
        const commentsList = document.getElementById('comments-list');
        toggleCommentsBtn.addEventListener('click', function() {
            if (commentsList.classList.contains('invisible')) {
                commentsList.classList.remove('invisible');
                console.log(commentsList);
            } else {
                commentsList.classList.add('invisible');
                console.log(commentsList);

            }
        });
    });

    const buttonSubmit = document.getElementById("submit-bttn");
    buttonSubmit.addEventListener("click", buttonClick, false);

    const buttonDelete = document.getElementById("delete-bttn");
    buttonDelete.addEventListener("click", deletePost, false);
    
    function buttonClick(event) {
        event.preventDefault();
        let comment = document.getElementById("comment").value;
        let postId = document.getElementById("postId").value;
        let userName = document.getElementById("userName").value;
        saveComment(comment, userName, postId)
        window.location.reload()
    }

async function saveComment(comment, userName, postId) {
                axios.post('/save-comment', {
                    	comment: comment,
                        userName: userName,
                        postId: postId,
                })
                .catch(function (error) {
                    console.log(error);
                });
            }


async function deletePost(event) {
    event.preventDefault();
    let postId = document.getElementById("postId").value;
    if (window.confirm("Do you really want to delete this post?")) {
        try {
            const response = await axios.post('/delete-post/' + postId);
            if (response.data == 1) {
                alert('Post deleted!');
                window.location.href = '/'
            }
        } catch (error) {
            console.error(error);
        }
      }
}