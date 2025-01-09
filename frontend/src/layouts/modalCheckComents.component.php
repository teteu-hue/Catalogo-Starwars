<div class="modal fade" id="checkCommentsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h1 class="modal-episode fs-5 p-2" id="exampleModalLabel"><span id="title-movie"></span></h1>
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body-comments">
                <p>Não existem comentários desse filme, seja o primeiro a comentar!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar detalhes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#checkCommentsBtn', function() {
        const episode = $(this).data('episode-id');

        $.ajax({
            url: "http://localhost:8081/comments",
            method: "GET",
            data: {
                id: episode
            },
            contentType: "application/x-www-form-urlencoded",
            success: function(response) {
                $(".modal-body-comments").empty();

                if (response.length > 0) {
                    response.forEach(comment => {
                        const formattedDate = formatDate(comment.created_at);

                        $(".modal-body-comments").append(`
                            <div class="comment mb-3">
                                <p class="m-2"><strong>Comentário:</strong> ${comment.comment}</p>
                                <p class="m-2"><small><strong>Data:</strong> ${formattedDate}</small></p>
                                <hr>
                            </div>
                        `);
                    });
                } else {
                    $(".modal-body-comments").html("<p>Não há comentários para este episódio.</p>");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: ", error);
                $(".modal-body-comments").html("<p>Erro ao carregar comentários.</p>");
            }
        })
    });

    function formatDate(dateString) {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }
</script>