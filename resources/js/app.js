// import './bootstrap';
import axios from 'axios';
// import { createApp } from 'vue';

// const app = createApp({});

// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

// app.mount('#app');
import 'tailwindcss/tailwind.css'
// import axios from 'axios';

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

    const button = document.getElementById("submit-bttn");
    button.addEventListener("click", buttonClick, false);

    function buttonClick(event) {
        event.preventDefault();
        let comment = document.getElementById("comment").value;
        let postId = document.getElementById("postId").value;
        let userName = document.getElementById("userName").value;

        saveComment(comment, userName, postId)
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