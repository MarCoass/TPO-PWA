<?php $data = Session::get('modalConsulta'); ?>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var modalConsulta = new bootstrap.Modal(document.getElementById('modalConsulta'), {
                                keyboard: false,
                                backdrop: 'static'
                            });
                            modalConsulta.show();
                        });
                    </script>

                    <!-- Modal -->
                    <div class="modal fade" id="modalConsulta" tabindex="-1" aria-labelledby="modalConsultaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalConsultaLabel">Desea actualizar datos?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Usted ya ha participado en otras competencias, desea actualizar algunos datos? </p>
                                    <p>Tu institucion registrada es: <b>{{ auth()->user()->escuela->nombre }}</b></p>
                                    @if (auth()->user()->idRol == 3)
                                    @php
                                        $miGraduacionActual = App\Models\Competidor::where('idUser', auth()->user()->id)->first();
                                    @endphp
                                    <p>Tu Graduacion registrada es: <b>{{ $miGraduacionActual->graduacion->nombre }} - {{ $miGraduacionActual->graduacion->color }}</b></p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No gracias</button>
                                    <a href="/solicitar_cambios/{{auth()->user()->id}}" class="btn btn-outline-primary ms-1"><i class="bi bi-person-gear me-2"></i>Solicitar cambios</a>
                                </div>
                            </div>
                        </div>
                    </div>
