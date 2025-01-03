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
<main id="movies-container" class="w-auto h-auto d-flex align-items-center flex-wrap m-5">
</main>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h1 class="modal-episode fs-5 p-2" id="exampleModalLabel"><span id="title-movie"></span></h1>
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>
                        <strong>Título:</strong> <span id="movie-title"></span>
                    </li>
                    <li>
                        <strong>Data de lancamento:</strong> <span id="movie-date"></span>
                    </li>
                    <li>
                        <strong>Número do Episódio:</strong> <span id="movie-episode"></span>
                    </li>
                    <li>
                        <strong>Diretor:</strong> <span id="movie-director"></span>
                    </li>
                    <li>
                        <strong>Produtores:</strong> <span id="movie-producer"></span>
                    </li>
                    <li>
                        <strong>Personagens</strong> <span id="movie-character"></span>
                    </li>
                    <li>
                        <strong>Sinopse:</strong> <span id="movie-opening"></span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar detalhes</button>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://localhost:8081/movies',
            method: 'GET',
            dataType: 'json',
            beforeSend: function(){
                const loading = `<div class="c-loader m-auto mt-5 justify-content-center"></div>`;
                const loadingText = `<h2 id="text-loader" class="text-center text-white mt-5 pt-5">Estamos carregando os filmes do catalogo</h2>`;

                $("#movies-container").before(loading);
                $(".c-loader").after(loadingText);
            },
            error: function(response) {
                const loading = `<div class="c-loader m-auto mt-5 justify-content-center"></div>`;
                const loadingText = `<h2 id="text-loader" class="text-center text-white mt-5 pt-5">Estamos carregando os filmes do catalogo</h2>`;

                $("#movies-container").before(loading);
                $(".c-loader").append(loadingText);
            },
            success: function(response) {

                $('#text-loader').remove();
                $('.c-loader').hide();

                response.forEach((movie) => {
                    const {
                        title,
                        opening_crawl,
                        episode_id,
                        producer,
                        director,
                        release_date,
                        characters
                    } = movie;

                    const characterList = characters
                    .map(charName => "<a href='#' class='text-decoration-none'>" + charName + "</a>")
                    .join(", ");

                    const card = `
                <div class="card m-5" style="width: 20rem;">
                    <div class="card-body bg-danger">
                        <h5 class="card-title text-white">${title}</h5>
                        <p class="card-text text-white">
                            ${opening_crawl}
                        </p>
                        <a href="#" 
                            id="details-button"
                            data-title="${title}"
                            data-opening="${opening_crawl}"
                            data-episode="${episode_id}"
                            data-producer="${producer}"
                            data-director="${director}"
                            data-date="${release_date}"
                            data-character="${characterList}"
                            data-bs-toggle="modal" 
                            data-bs-target="#exampleModal" 
                            class="btn btn-primary text-white">Detalhes...</a>
                    </div>
                </div>`;
                    $('#movies-container').append(card);
                })
            }
        });

        $(document).on('click', '#details-button', function() {
            const title = $(this).data('title');
            const opening = $(this).data('opening');
            const episode = $(this).data('episode');
            const producer = $(this).data('producer');
            const director = $(this).data('director');
            const date = $(this).data('date');
            const character = $(this).data('character');

            const formattedDate = moment(date).format("DD [de] MMMM [de] YYYY");

            $("#title-movie").text(title);
            $("#movie-title").text(title);
            $("#movie-date").text(formattedDate);
            $("#movie-opening").text(opening);
            $("#movie-episode").text(episode);
            $("#movie-producer").text(producer);
            $("#movie-director").text(director);
            $("#movie-character").html(character);
        });
    });
</script>