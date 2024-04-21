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

    if (elementExists("comments-list")) {
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

        let categories = Array.from(document.querySelectorAll('.category-checkbox'));
            categories.forEach(category => {
                category.addEventListener("change", function() {
                    updateCategories(category);
                });
        })

        function updateCategories(category) {
                let categoryId = category.id.split('_')[1]
                if (elementExists('postId')) {
                let postId = document.getElementById('postId').value

                axios.post('/add-category/' + postId + '/' + categoryId, {
                    postId: postId,
                    categoryId: categoryId,
                })
                .then(function(response) {
                    if (response.data == 1) {
                        let categoryElement = document.getElementById('cat_' + categoryId).parentNode.parentNode;
                        let categoryDiv = category.parentNode
                        if (categoryElement) {
                            categoryElement.removeChild(categoryDiv);
                            addCategoryToPost(category.name, categoryId)
                        }
                    }
                })
                .catch(function(error) {
                    console.error(error);
                    alert('An error occurred while removing the category.');
                });
            } else {
                updateSelectedCategories()
                // FOR NEW POST WITH CATEGORIES
            }

        }

        function updateSelectedCategories() {
            let selectedCategories = Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => checkbox.value);
            let selectedCategoriesJSON = JSON.stringify(selectedCategories);
            console.log(selectedCategoriesJSON)
            document.getElementById('selectedCategories').value = selectedCategoriesJSON;

        }


        function addCategoryToPost(categoryName, categoryId) {
            let newCategoryElement = document.createElement('div');
            newCategoryElement.classList.add('flex', 'items-center', 'bg-gray-200', 'rounded-full', 'px-3', 'py-1', 'm-1');
        
            let categoryNameSpan = document.createElement('span');
            categoryNameSpan.textContent = categoryName;
            newCategoryElement.appendChild(categoryNameSpan);

            let removeButton = document.createElement('button');
            removeButton.setAttribute('type', 'button');
            removeButton.classList.add('ml-2', 'text-gray-500', 'hover:text-gray-700', 'focus:outline-none', 'remove-category');
            removeButton.setAttribute('data-postid', postId);
            removeButton.setAttribute('data-categoryid', categoryId);
            removeButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `;
            removeButton.addEventListener('click', function() {
                removeCategory(postId.value, categoryId);
            });

            newCategoryElement.appendChild(removeButton);
        
            let categoryList = document.getElementById('category-added-section');
            categoryList.appendChild(newCategoryElement);
        }

        document.addEventListener("DOMContentLoaded", () => {
    
            const removeButtons = document.querySelectorAll('.remove-category');

            removeButtons.forEach(button => {
                button.addEventListener("click", function() {
                    let postId = button.dataset.postid; // Changed to postid
                    let categoryId = button.dataset.categoryid;
                    removeCategory(postId, categoryId);
                });
            });
        });
    }
    
    function removeCategory(postId, categoryId) {

        axios.post('/remove-category/' + postId + '/' + categoryId, {
            categoryId: categoryId
        })
        .then(function(response) {
            let removedCategory = response.data.allcategories.find(category => category.id == categoryId);

            let categoryAddedSection = document.getElementById('category-added-section');

            let categoryToRemove = categoryAddedSection.querySelector(`[data-categoryid="${categoryId}"]`);
            if (categoryToRemove) {
                categoryToRemove.parentNode.remove();
            }
    
            if (removedCategory) {
                let categoryElement = 
                `<div class="flex items-center cursor-pointer mr-4">
                    <input type="checkbox" name="` +  removedCategory.name + `" id="cat_` +  removedCategory.id + `" value="` +  removedCategory.id + `" class="hidden category-checkbox">
                    <label for="cat_` +  removedCategory.id + `" class="px-3 py-1 rounded-full bg-gray-300 hover:bg-gray-400">` +  removedCategory.name + `</label>
                </div>`;

                let flexDiv = document.querySelector('#category-missing-section .flex');
                flexDiv.insertAdjacentHTML('beforeend', categoryElement);

                let categoryInput = document.getElementById('cat_'  +  removedCategory.id)
                categoryInput.addEventListener("change", function() {
                    updateCategories(categoryInput);
                });
            }            
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