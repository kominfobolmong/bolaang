<!DOCTYPE html>
<html lang="en">

<head>
@include('bolmongkab.layout.head')
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
    @include('bolmongkab.layout.header')
    </header><!-- End Header -->
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex align-items-center">
                    <ol>
                        <li><a href="{{ ('/') }}">Home</a></li>
                        <li>Bupati</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= detail Section ======= -->
        <section id="detail" class="detail">
         @foreach ($bupati as $bpati)
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-ls-12">
                        <div class="judul">
                            <h2 class="animate__animated animate__bounceInDown">{{ $bpati->nama }}</h2>
                            <h3 class="animate__animated animate__bounceInDown">Bupati Bolaang Mongondow</h3>
                            <hr>
                        </div>
                        <p class="animate__animated animate__bounceInLeft animate__fast">{!! nl2br(e($bpati->body)) !!}</p>
                    </div>

                    <div class="col-lg-4 col-ls-12">
                    <img src="{{ $bpati->image }}" class="bupati animate__animated animate__bounceInRight animate__fast">
                    </div>
                </div>
            </div>
            @endforeach
          

        </section><!-- End detail Section -->


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
    @include('bolmongkab.layout.footer')
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    @include('bolmongkab.layout.script')

</body>

</html>
