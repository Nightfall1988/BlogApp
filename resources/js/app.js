import './bootstrap';
import axios from 'axios';
// import { createApp } from 'vue';

// const app = createApp({});

// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

// app.mount('#app');
const button = document.getElementById("submit-bttn");
button.addEventListener("click", buttonClick, false);

function buttonClick(event) {
    event.preventDefault();
    let comment = document.getElementById("comment").value;
    console.log(comment);
}