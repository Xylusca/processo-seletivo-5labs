<div class="col-sm-6 col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <div class="border rounded-circle bg-dark py-2 px-3 border-dark">
                    <i class="fas fa-user text-white" style="font-size: 33px"></i>
                </div>
                <div class="ms-3">
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="mb-3">
                        <p class="fw-bold mb-2">Tipo:</p>
                        <p class="fw-bold mb-3">Status:</p>
                        <p class="fw-bold mb-2">Estado:</p>
                        <p class="fw-bold mb-2">Nascimento:</p>
                        <p class="fw-bold mb-2">CPF:</p>
                        <p class="fw-bold mb-2">Créditos:</p>
                    </div>
                </div>
                <div class="col-7">
                    <div class="mb-3">
                        <p class="fw-normal mb-1">{{ $user->nivel->name }}</p>
                        <form action="{{ route('atualizarStatus', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group">
                                <select name="status" class="form-select me-2 rounded @if ($user->status === 'pendente') bg-warning
                                    @elseif ($user->status === 'ativo') bg-success
                                    @endif">
                                    <option value="pendente" class="bg-white text-dark" {{ $user->status === 'pendente' ? 'selected' : '' }}>
                                        Pendente</option>
                                    <option value="ativo" class="bg-white text-dark" {{ $user->status === 'ativo' ? 'selected' : '' }}>Ativo
                                    </option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm rounded">Salvar</button>
                            </div>
                        </form>
                        <p class="fw-normal my-2">{{ $user->state }}</p>
                        <p class="fw-normal mb-2">
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $user->birthdate)->format('d/m/Y') }}
                        </p>
                        <p class="fw-normal mb-2">{{ $user->cpf }}</p>
                        <p class="fw-normal mb-2">{{ $user->credits }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
