@extends('layouts.app')

@section('title', 'FAQ TOEFL')

@section('content')
    @include('backend.sidebar')

    <div class="page-wrapper bg-light">
        <div class="container py-5" style="max-width: 800px;">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-4 text-center" style="color: #213555;">Bagaimana kami dapat membantu Anda?</h1>

                    <div class="container overflow-hidden text-center">
                        <div class="row gx-5">
                            <div class="col">
                                <img src="/images/help-illustration.svg" alt="Helping" class="img-fluid">
                            </div>
                            <div class="col">
                                <img src="/images/help-illustration2.svg" alt="Helping" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <hr class="my-5">

                    <h2 class="fw-bold mb-4">Jelajahi topik bantuan</h2>

                    <!-- FAQ Dropdown -->
                    <div class="accordion" id="faqAccordion">
                        <!-- Question 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Bagaimana cara mendaftar dan membuat akun TOEFL?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda dapat mendaftar untuk akun TOEFL melalui situs web resmi TOEFL. Pastikan Anda
                                    mengisi informasi dengan benar untuk memulai.
                                </div>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Apa saja persyaratan untuk mengikuti tes TOEFL?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Untuk mengikuti tes TOEFL, Anda perlu memiliki akun TOEFL, membayar biaya ujian, dan
                                    memilih jadwal tes yang tersedia.
                                </div>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Apa saja metode pembayaran yang tersedia untuk TOEFL?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Pembayaran untuk tes TOEFL dapat dilakukan melalui kartu kredit, transfer bank, atau
                                    metode pembayaran lain yang disediakan oleh TOEFL.
                                </div>
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Bagaimana cara mengunggah bukti pembayaran?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="faqFour"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Bukti pembayaran dapat diunggah melalui halaman akun TOEFL Anda setelah melakukan
                                    pembayaran.
                                </div>
                            </div>
                        </div>

                        <!-- Question 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Apa yang harus dilakukan jika ingin mengubah jadwal tes?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="faqFive"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda dapat mengubah jadwal tes melalui akun TOEFL Anda dengan memilih opsi reschedule
                                    tes yang tersedia.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="mt-5 text-muted">
                        <p class="mb-0">TOEFLSupport@toeflservice.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .page-wrapper {
            min-height: 100vh;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table a {
            color: #1a73e8;
        }

        .table a:hover {
            text-decoration: underline;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #dadce0;
        }

        .form-control:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
        }

        hr {
            border-top: 1px solid #dadce0;
        }

        .accordion-button {
            background-color: #f7f8fa;
            border: 1px solid #dadce0;
            font-weight: bold;
        }

        .accordion-button:not(.collapsed) {
            background-color: #1a73e8;
            color: white;
        }

        .accordion-body {
            background-color: #f1f3f4;
        }
    </style>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection