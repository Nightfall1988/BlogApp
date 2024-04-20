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

    if (elementExists("category-missing-section")) {

        const categories = Array.from(document.querySelectorAll('.category-checkbox'));

            categories.forEach(category => {
                category.addEventListener("change", function() {
                    toggleCategory(category)
            });
        })

        function toggleCategory(category) {

        if (category.checked) {
            category.nextElementSibling.classList.remove('bg-gray-300');
            category.nextElementSibling.classList.add('bg-blue-500');
        } else {
            category.nextElementSibling.classList.remove('bg-blue-500');
            category.nextElementSibling.classList.add('bg-gray-300');
        }
            updateCategories(category);
        }

        function updateCategories(category) {
            let categoryId = category.id.split('_')[1]
            let postId = document.getElementById('postId').value

            axios.post('/remove-category/' + postId + '/' + categoryId, {
                postId: postId,
                categoryId: categoryId,
            })
            .then(function(response) {
                if (response.data == 1) {
                    let categoryElement = document.getElementById('cat_' + categoryId).parentNode.parentNode;
                    let categoryDiv = category.parentNode
                    if (categoryElement) {
                        console.log(categoryDiv)
                        categoryElement.removeChild(categoryDiv);
                        addCategoryToUI(category.name, categoryId)
                    }
                }
            })
            .catch(function(error) {
                console.error(error);
                alert('An error occurred while removing the category.');
            });
        }


        function addCategoryToUI(categoryName, categoryId) {
            let newCategoryElement = document.createElement('div');
            newCategoryElement.classList.add('flex', 'items-center', 'bg-gray-200', 'rounded-full', 'px-3', 'py-1', 'm-1');
        
            let categoryNameSpan = document.createElement('span');
            categoryNameSpan.textContent = categoryName;
            newCategoryElement.appendChild(categoryNameSpan);
        
            let removeButton = document.createElement('button');
            removeButton.setAttribute('type', 'button');
            removeButton.classList.add('ml-2', 'text-gray-500', 'hover:text-gray-700', 'focus:outline-none', 'remove-category');
            removeButton.setAttribute('data-post-id', postId);
            removeButton.setAttribute('data-category-id', categoryId);
            removeButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `;
            removeButton.addEventListener('click', function() {
                updateCategories(this);
            });
            newCategoryElement.appendChild(removeButton);
        
            let categoryList = document.getElementById('category-added-section');
            categoryList.appendChild(newCategoryElement);
        }

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