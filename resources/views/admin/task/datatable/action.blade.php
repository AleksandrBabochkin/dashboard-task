<div class="row">
    <a href="{{ route('task.edit', $id) }}" type="button" class="btn btn-primary data-table-edit mb-1">
        <i class="fas fa-edit"></i>
    </a>
    @pm
        <button onclick="DatatableHelper.delete_method('{{ route('task.destroy', $id) }}', '{{ csrf_token() }}')"
                type="button" class="btn btn-danger mb-1"><i class="fas fa-eraser"></i>
        </button>
    @endpm
</div>
