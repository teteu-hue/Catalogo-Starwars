<main id="movies-container" class="w-auto h-auto d-flex align-items-center flex-wrap m-5">

</main>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://localhost:8081/movies',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                response.forEach((movie) => {
                    const {
                        title,
                        opening_crawl
                    } = movie;
                    console.log(movie);
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