import axios from 'axios';
import 'tailwindcss/tailwind.css';

function elementExists(elementId) {
    return document.getElementById(elementId) !== null;
}

    if (elementExists("submit-bttn")) {
        const buttonSubmit = document.getElementById("submit-bttn");
        buttonSubmit.addEventListener("click", buttonClick, false);
    }

    if (elementExists("delete-bttn")) {
        const buttonDelete = document.getElementById("delete-bttn");
        buttonDelete.addEventListener("click", deletePost, false);
    }

    if (elementExists("delete-bttn")) {
        document.addEventListener('DOMContentLoaded', function() {
            const toggleCommentsBtn = document.getElementById('toggle-comments');
            const commentsList = document.getElementById('comments-list');
            toggleCommentsBtn.addEventListener('click', function() {
                if (commentsList.classList.contains('invisible')) {
                    commentsList.classList.remove('invisible');
                } else {
                    commentsList.classList.add('invisible');
                }
            });
        });
    }

    console.log('0');

    if (elementExists("category-missing-section")) {

        const categories = Array.from(document.querySelectorAll('.category-checkbox'));

            categories.forEach(category => {
                category.addEventListener("change", function() {
                    toggleCategory(category)
            });
        })


        function toggleCategory(category) {

        checkbox.checked = !checkbox.checked;
        if (checkbox.checked) {
            checkbox.nextElementSibling.classList.remove('bg-gray-300');
            checkbox.nextElementSibling.classList.add('bg-blue-500');
        } else {
            checkbox.nextElementSibling.classList.remove('bg-blue-500');
            checkbox.nextElementSibling.classList.add('bg-gray-300');
        }
            updateSelectedCategories();
        }

        function updateSelectedCategories() {
            const selectedCategories = Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => checkbox.value);
            document.getElementById('selectedCategories').value = JSON.stringify(selectedCategories);
            console.log(document.getElementById('selectedCategories').value);
        }
        
        // SOLVE THE toggleCategory AND removeCategory ISSUE


        document.addEventListener("DOMContentLoaded", () => {
    
            const removeButtons = document.querySelectorAll('.remove-category');
            removeButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const postId = button.dataset.postId;
                    const categoryId = button.dataset.categoryId;
                    removeCategory(postId, categoryId);
                });
            });
        });
    }
    
    function removeCategory(postId, categoryId) {
        axios.post('/remove-category/' + postId, {
            category_ids: [categoryId]
        })
        .then(function(response) {
            console.log(response.data);
            alert('Category removed successfully!');
            // Optionally, you can update the UI here to reflect the changes
        })
        .catch(function(error) {
            console.error(error);
            alert('An error occurred while removing the category.');
        });
    }
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