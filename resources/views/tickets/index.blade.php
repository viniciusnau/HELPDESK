@extends('layouts.app')

@section('content')

<h2>Gestão de Chamados</h2>

<button class="btn btn-success mb-3" onclick="openCreateModal()">
    Novo Chamado
</button>

<div class="card">
    <div class="card-body">

        <div class="row mb-3">
            <div class="col-md-4">
                <select id="filterStatus" class="form-control">
                    <option value="">Todos Status</option>
                    <option value="open">Aberto</option>
                    <option value="in_progress">Em progresso</option>
                    <option value="resolved">Resolvido</option>
                </select>
            </div>

            <div class="col-md-4">
                <select id="filterCategory" class="form-control">
                    <option value="">Todas Categorias</option>
                </select>
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary" onclick="loadTickets()">Filtrar</button>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Status</th>
                    <th>Categoria</th>
                    <th>Criado por</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="ticketsTable"></tbody>
        </table>

    </div>
</div>

@endsection

@push('scripts')

<script>

function openCreateModal(){
    const modal = new bootstrap.Modal(document.getElementById('createTicketModal'))
    modal.show()
}

function loadTickets() {

    let status = $('#filterStatus').val()
    let category = $('#filterCategory').val()

    $.get('/api/tickets', {
        status: status,
        category_id: category
    }, function(data){

        let rows = ''

        if (!data.data || data.data.length === 0) {
            rows = `<tr><td colspan="5">Nenhum chamado encontrado</td></tr>`
        } else {
            data.data.forEach(ticket => {
                rows += `
                <tr>
                    <td>${ticket.title}</td>
                    <td>${ticket.status}</td>
                    <td>${ticket.category?.name ?? '-'}</td>
                    <td>${ticket.created_by}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteTicket(${ticket.id})">
                            Deletar
                        </button>
                    </td>
                </tr>
                `
            })
        }

        $('#ticketsTable').html(rows)

    })
}

function loadCategories(){

    $.get('/api/categories', function(data){

        $('#filterCategory').html('<option value="">Todas Categorias</option>')
        $('#category_id').html('')

        let categories = data.data ?? data

        categories.forEach(cat => {

            $('#filterCategory').append(
                `<option value="${cat.id}">${cat.name}</option>`
            )

            $('#category_id').append(
                `<option value="${cat.id}">${cat.name}</option>`
            )

        })

    })
}


function createTicket(){

    $.ajax({
        url: '/api/tickets',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            title: $('#title').val(),
            description: $('#description').val(),
            category_id: $('#category_id').val(),
            created_by: $('#created_by').val()
        }),
        success: function(){

            loadTickets()
            const modal = bootstrap.Modal.getInstance(document.getElementById('createTicketModal'))
            modal.hide()

        }
    })

}

function deleteTicket(id){

    if(!confirm('Deseja deletar este chamado?')) return

    $.ajax({
        url: '/api/tickets/' + id,
        method: 'DELETE',
        success: function(){
            loadTickets()
        }
    })

}

$(function(){
    loadTickets()
    loadCategories()
})

</script>

<div class="modal fade" id="createTicketModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Criar Chamado</h5>
            </div>

            <div class="modal-body">

                <input id="title" class="form-control mb-2" placeholder="Título">

                <textarea id="description" class="form-control mb-2" placeholder="Descrição"></textarea>

                <select id="category_id" class="form-control mb-2"></select>

                <input id="created_by" class="form-control mb-2" placeholder="Criado por">

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" onclick="createTicket()">Salvar</button>
            </div>

        </div>
    </div>
</div>


@endpush
