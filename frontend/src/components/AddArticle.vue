<template>
    <div class="container">
        <h2>Add an Article</h2>
        <form @submit.prevent="addArticle" class="mb-4">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" v-model="title" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea id="content" v-model="content" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <input type="text" id="category" v-model="category" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image URL:</label>
                <input type="text" id="image" v-model="image" class="form-control" />
            </div>

            <button type="submit" class="btn btn-primary">Add Article</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import $ from "jquery"; // Import jQuery
import "bootstrap/dist/css/bootstrap.min.css"; // Import Bootstrap CSS
import "datatables.net"; // Import DataTables

export default {
    data() {
        return {
            title: "",
            content: "",
            category: "",
            image: "",
            articles: [],
        };
    },
    mounted() {
        this.loadArticles();
        // Initialize DataTables plugin
        $(this.$el).find("table").DataTable();
    },
    methods: {
        async addArticle() {
            try {
                await axios.post("http://localhost:8000/api/articles", {
                    title: this.title,
                    content: this.content,
                    category: this.category,
                    image: this.image
                });
                this.loadArticles();
                this.clearForm();
            } catch (error) {
                console.error("Error adding article:", error);
            }
        },
        async loadArticles() {
            try {
                const response = await axios.get("http://localhost:8000/api/articles");
                this.articles = response.data;
                // Destroy and reinitialize DataTables to reflect changes
                $(this.$el).find("table").DataTable().destroy();
                $(this.$el).find("table").DataTable();
            } catch (error) {
                console.error("Error loading articles:", error);
            }
        },
        editArticle(article) {
            // Implement editing logic here
            console.log("Editing article:", article);
        },
        deleteArticle(articleId) {
            // Implement deletion logic here
            console.log("Deleting article with ID:", articleId);
        },
        clearForm() {
            this.title = "";
            this.content = "";
            this.category = "";
            this.image = "";
        },
    },
};
</script>
<style scoped>
/* Add your custom styles here */
</style>
