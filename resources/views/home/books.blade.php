<div class="currently-market">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2><em>Buku</em> yang sekarang tersedia.</h2>
                </div>
            </div>
        </div>

        @include('home.message')

        <div class="col-lg-12">
            <div class="row grid">

                <!-- Loop through the books and display them -->
                @foreach ($book as $books)
                    <div class="col-lg-6 currently-market-item all msc">
                        <div class="item">
                            <div class="left-image">
                                <img src="{{ asset('book_cover_images/' . $books->cover_image) }}" alt="Cover"
                                    style="border-radius: 20px; min-width: 270px; max-width: 300px;">
                            </div>
                            <div class="right-content">
                                <h4 style="margin-bottom: 2px;">{{ $books->title }}</h4>
                                <h6 class="text-muted" style="margin-top: 0; margin-bottom: 10px;">
                                    {{ $books->category->cat_title }}
                                </h6>
                                <span class="author">
                                    <h6 style="font-style: italic;">{{ $books->author }}</h6>
                                </span>
                                <p class="description">{{ $books->description }}</p>
                                <div class="line-dec"></div>
                                <span class="bid">
                                    Tersedia Saat Ini<br><strong>{{ $books->quantity }} pcs</strong><br>
                                </span>
                                <div class="text-button">
                                    <a href="#">Lihat Detail Buku</a>
                                </div>
                                <br>
                                <div class="">
                                    <a class="btn btn-primary" href="{{ url('borrow_books', $books->id) }}">Pinjam
                                        Buku</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End of book loop -->

            </div>
        </div>
    </div>
</div>
