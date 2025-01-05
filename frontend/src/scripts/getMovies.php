<script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://localhost:8081/movies',
            method: 'GET',
            dataType: 'json',
            beforeSend: function() {
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
                        characters,
                        film_age
                    } = movie;

                    const characterList = characters
                        .map(charName => "<a href='#' class='text-decoration-none'>" + charName + "</a>")
                        .join(", ");


                    const card = `
                <div class="card mx-auto d-flex m-5" style="width: 40rem;">
                    <div class="card-body " style="background-color:#8C0B23;">
                        <h5 class="card-title text-white font-bold h1">${title}</h5>
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
                            data-years="${film_age.anos}"
                            data-months="${film_age.meses}"
                            data-days="${film_age.dias}"
                            data-character="${characterList}"
                            data-bs-toggle="modal" 
                            data-bs-target="#exampleModal" 
                            class="btn btn-primary text-white">Detalhes</a>
                        <a href="#" 
                            id="commentsBtn"
                            data-bs-toggle="modal"
                            data-episode-id="${episode_id}"
                            data-bs-target="#commentsModal" 
                            class="btn btn-success text-white">Comente a respeito desse filme</a>
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
            const years = $(this).data('years');
            const months = $(this).data('months');
            const days = $(this).data('days');

            const formattedDate = moment(date).format("DD [de] MMMM [de] YYYY");

            $("#title-movie").text(title);
            $("#movie-title").text(title);
            $("#movie-date").text(formattedDate);
            $("#movie-opening").text(opening);
            $("#movie-episode").text(episode);
            $("#movie-producer").text(producer);
            $("#movie-director").text(director);
            $("#movie-character").html(character);
            $("#movie-years").text(years);
            $("#movie-months").text(months);
            $("#movie-days").text(days);
        });
    });
</script>