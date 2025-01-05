<div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h1 class="modal-episode fs-5 p-2" id="exampleModalLabel"><span id="title-movie"></span></h1>
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form class="form-group" action="http://localhost:8081/comments" method="POST">
                    <input type="text" class="form-control" placeholder="Faça um comentário">
                    <button class="btn btn-primary mt-1">Enviar comentário</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar detalhes</button>
            </div>
        </div>
    </div>
</div>
</div>