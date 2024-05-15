@extends('admin_layouts.master')

@section('page_title')
    List Data Token
@endsection

@section('content')
    <div class="row">
        <div class="col-3 mb-5" style="border: 1px solid #0F3077;">
            <h4 class="text-center my-2" style="color: #0F3077">Daftar Token</h4>
        </div>

        <div class="col-9"></div>

        <div class="col-4 mb-3 ms-auto">
            <div class="row">
                <div class="col">
                    <button class="btn btn-md w-100 mb-2" style="background-color: #4FA7F9; color: #000000;"
                        onclick="generateTokenModal()">Generate Simulation</button>
                </div>
                <div class="col">
                    <button class="btn btn-md w-100 mb-2" style="background-color: #4FA7F9; color: #000000;"
                        onclick="regenerateToken('Download', 'token-Download')">Generate Download</button>
                </div>
            </div>
        </div>



        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="col-12">
            <table class="table table-bordered">
                <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
                    <th>No</th>
                    <th>Token</th>
                    <th>Token Activation</th>
                    <th>Token Expiration</th>
                    <th>Type</th>
                </thead>
                <tbody style="color: #1C4B8F">
                    @foreach ($tokens as $key => $token)
                        <tr data-id="{{ $token->id }}"
                            style="@if ($key % 2 != 0) background-color: #DFF8FD; @else background-color: #FFFFFF @endif">
                            <td class="align-middle text-center" style="width: 8%">{{ $key + 1 }}</td>
                            <td class="align-middle text-center" style="width: 24%" id="token-{{ $token->exam_token_id }}">
                                {{ $token->token }}</td>
                            <td class="align-middle text-center" style="width: 16%">Start Date</td>
                            <td class="align-middle text-center" style="width: 16%">End Date</td>
                            <td class="align-middle text-center" style="width: 16%"><span
                                    class="badge bg-secondary">{{ $token->status }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="generateTokenModal" tabindex="-1" aria-labelledby="generateTokenModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="generateTokenModelLabel">Konfirmasi Generate Token</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin melanjutkan? Data pada halaman statistika akan direset dengan pembuatan
                        token baru.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a class="btn" style="background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA"
                            onclick="regenerateToken('Simulasi', 'token-Simulasi')">Lanjutkan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function generateTokenModal() {
            $('#generateTokenModal').modal('show');
        }

        function regenerateToken(status, elementId) {
            fetch('{{ route('generateToken') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    var tokenElement = document.getElementById('token-' + data.data
                        .exam_token_id);

                    if (tokenElement) {
                        tokenElement.innerHTML = data.data
                            .token;
                    }

                    $('#generateTokenModal').modal('hide');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endpush
