@extends('layouts.app')

@section('container')
  <section>
  
    <div class="row justify-content-center py-4">
      <div class="col-md-6 text-center">
        <h2 class="fs-2 mb-4">Tentang Kami</h2>
        <p class="fs-5" style="text-align: justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iure,
          perspiciatis itaque. Nisi harum
          facilis velit vel
          quod laboriosam voluptatibus cupiditate eum, beatae magnam dolore incidunt, voluptatem deserunt cumque? Error
          totam temporibus earum adipisci excepturi, odio alias ea nemo optio? Deserunt harum temporibus ea, tenetur ad
          neque, sunt repellendus tempore sequi quas vitae nulla aspernatur fugit vero dolor qui hic nam eaque illo.
          Libero,
          accusamus? Necessitatibus consectetur quaerat similique eligendi inventore ratione et pariatur suscipit rem
          laudantium minus maiores, sed consequuntur voluptate quisquam sit at doloribus quia itaque! Ab laboriosam, eius
          obcaecati sit sint quos beatae necessitatibus explicabo fugit aperiam voluptas!</p>
      </div>
    </div>
  </section>

  <section>
    <div class="row text-center justify-content-center pt-4">
      <div class="col">
        <h2 class="mb-4">Langkah Pendaftaran</h2>
      </div>
    </div>

    <div class="row text-center justify-content-center pb-4 mt-3">
      <div class="col-md-2 d-flex gap-2">
        <div class="card mb-2">
          <div class="card-body">
            <p style="text-align: justify">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
              veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card mb-2">
          <div class="card-body">
            <p style="text-align: justify">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
              veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card mb-2">
          <div class="card-body">
            <p style="text-align: justify">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
              veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card mb-2">
          <div class="card-body">
            <p style="text-align: justify">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
              veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card mb-2">
          <div class="card-body">
            <p style="text-align: justify">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
              veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card mb-2">
          <div class="card-body">
            <p style="text-align: justify">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
              veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="row text-center justify-content-center pt-4">
      <div class="col">
        <h2 class="mb-4">List Lowongan Kerja</h2>
      </div>
    </div>
    <div class="card-group">
      <div class="card me-3 ms-1">
        <img src="{{ asset('assets/images/2.jpeg') }}" class="card-img-top" alt="..." >
        <div class="card-body ">
          <h5 class="card-title">IT Consultant</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
      </div>
      <div class="card me-3 ms-1">
        <img src="{{ asset('assets/images/3.jpeg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">System Analyst</h5>
          <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
      </div>
      <div class="card me-2 ">
        <img src="{{ asset('assets/images/4.jpeg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Fullstack Dev</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
      </div>
    </div>

  </section>
@endsection
