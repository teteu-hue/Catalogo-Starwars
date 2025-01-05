<style>
    .c-loader {
        border: 6px solid #e5e5e5;
        border-top-color: #51d4db;
        height: 50px;
        width: 50px;
        animation: is-rotating 1s infinite;
        border-radius: 50%;
    }

    @keyframes is-rotating {
        to {
            transform: rotate(1turn);
        }
    }
</style>
<h1 class="text-center mt-5 pt-5 text-white">Catalogo de Filmes</h1>
<main id="movies-container" class="w-auto h-auto d-flex align-items-center flex-wrap justify-content-between">
</main>

<?= include_once __DIR__ . "/../layouts/modalDetails.component.php" ?>
<?= include_once __DIR__ . "/../layouts/modalComments.component.php" ?>
<?= include_once __DIR__  .  "/../scripts/getMovies.php" ?>



