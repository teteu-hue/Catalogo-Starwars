<style>
    .c-loader{
        border: 6px solid #e5e5e5;
        border-top-color: #51d4db; 
        height: 50px; 
        width: 50px; 
        animation: is-rotating 1s infinite; 
        border-radius:50%;
    }

    @keyframes is-rotating{
        to{
            transform: rotate(1turn);
        }
    }
</style>
<h1 class="text-center mt-5 pt-5 text-white">Catalogo de Filmes</h1>
<main id="movies-container" class="w-auto h-auto d-flex align-items-center flex-wrap m-5">
</main>


<script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://localhost:8081/movies',
            method: 'GET',
            dataType: 'json',
            error: function (response){
                const loading = `<div class="c-loader m-auto mt-5 justify-content-center"></div>`;
                const h2 = `<h2 class="text-center text-white mt-5 pt-5">Estamos carregando os filmes do catalogo</h2>`;

                $("#movies-container").before(loading);
                $(".c-loader").after(h2);
            },
            success: function(response) {
                response.forEach((movie) => {
                    const {
                        title,
                        opening_crawl
                    } = movie;
                    const card = `
                <div class="card m-5" style="width: 20rem;">
                    <div class="card-body bg-danger">
                        <h5 class="card-title text-white">${title}</h5>
                        <p class="card-text text-white">
                            ${opening_crawl}
                        </p>
                        <a href="#" id="details-button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary text-white">Detalhes...</a>
                    </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <h1 class="modal-title fs-5 p-2" id="exampleModalLabel">${title}</h1>
                            <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                    </div>
                    </div>
                </div>`;
                    $('#movies-container').append(card);
                })
            }
        });

        $('#details-button').click(function() {
            const title = $(this).data;
            console.log(title);
        });
    });
</script>