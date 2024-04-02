<template>
  <div class="container">
    <h2>Liste des articles 1</h2>
    <table id="ArticlesTable" class="table">
      <thead>
        <tr>

          <th>title</th>

          <th></th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
import $ from "jquery"; // Import jQuery
import "bootstrap/dist/css/bootstrap.min.css"; // Import Bootstrap CSS
import "datatables.net-bs5/css/dataTables.bootstrap5.min.css"; // Import DataTables Bootstrap 5 styling
import "datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"; // Import DataTables Buttons Bootstrap 5 styling
import "datatables.net"; // Import DataTables library
import "datatables.net-buttons"; // Import DataTables Buttons extension

export default {
  data() {
    return {
      articles: [],
      dataTable: null,
    };
  },
  mounted() {
    this.initializeDataTable();
    this.loadArticles();
  },
  methods: {
    initializeDataTable() {
      this.dataTable = $(this.$el)
        .find(".table")
        .DataTable({
          orderCellsTop: true,
          dom: "Bfrtip",
          order: [
            [0, "asc"],
            [1, "asc"],
          ],

          responsive: true,
          animate: true,
          paging: true,
          lengthChange: true,
          searching: true,
          ordering: true,
          info: true,
          autoWidth: true,
          processing: true,
          columnFilter: true,
          fixedColumns: true,
          language: {
            processing: "Traitement en cours...",
            search: "Rechercher&nbsp;:",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:
              "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:
              "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix: "",
            loadingRecords: "Chargement en cours...",
            zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable: "Aucune donnée disponible dans le tableau",
            paginate: {
              first: "Premier",
              previous: "Pr&eacute;c&eacute;dent",
              next: "Suivant",
              last: "Dernier",
            },
            aria: {
              sortAscending:
                ": activer pour trier la colonne par ordre croissant",
              sortDescending:
                ": activer pour trier la colonne par ordre décroissant",
            },
          },
        });
    },
    async loadArticles() {
      try {
        const response = await axios.get("http://localhost:8000/api/articles");
        this.articles = response.data;

        // Destroy existing DataTable instance if it exists
        if (this.dataTable) {
          this.dataTable.destroy();
        }

        // Reinitialize DataTables with fetched data
        this.$nextTick(() => {
          this.dataTable = $(this.$el)
            .find("table")
            .DataTable({
              data: this.articles,
              columns: [
                { data: "title" },
                {
                  data: null,
                  render: function (data, type, row) {
                    return `

                      <button class="btn btn-sm btn-danger" data-article-id="${row.id}" data-action="delete"><i class="fas fa-remove"></i></button>
                    `;
                  },
                },
              ],

              language: {
                processing: "Traitement en cours...",
                search: "Rechercher&nbsp;:",
                lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                info: "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                infoEmpty:
                  "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered:
                  "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix: "",
                loadingRecords: "Chargement en cours...",
                zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable: "Aucune donnée disponible dans le tableau",
                paginate: {
                  first: "Premier",
                  previous: "Pr&eacute;c&eacute;dent",
                  next: "Suivant",
                  last: "Dernier",
                },
                aria: {
                  sortAscending:
                    ": activer pour trier la colonne par ordre croissant",
                  sortDescending:
                    ": activer pour trier la colonne par ordre décroissant",
                },
              },
            });

          $(this.$el)
            .find("button[data-action='edit']")
            .click(this.handleEditButtonClick);
          $(this.$el)
            .find("button[data-action='delete']")
            .click(this.handleDeleteButtonClick);
        });
      } catch (error) {
        console.error("Error loading articles:", error);
      }
    },
    handleEditButtonClick(event) {
      const articleId = $(event.currentTarget).data("article-id");
      this.editArticle(articleId);
    },
    handleDeleteButtonClick(event) {
      const articleId = $(event.currentTarget).data("article-id");
      this.deleteArticle(articleId);
    },
    editArticle(articleId) {
      console.log("Editing article with ID:", articleId);
    },
    async deleteArticle(articleId) {
      try {
        await axios.delete(`http://localhost:8000/api/articles/${articleId}`);
        console.log("Article deleted successfully:", articleId);
        this.loadArticles(); // Reload articles after deletion
      } catch (error) {
        console.error("Error deleting article:", error);
      }
    },
  },
};
</script>

<style scoped>

</style>
