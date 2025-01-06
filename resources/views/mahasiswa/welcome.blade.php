<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FinalEase - Landing Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
  <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">

  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      box-sizing: border-box;
    }

    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .content {
      flex: 1;
    }

    /* Kotak Header dengan Logo dan User */
    .header-box {
      background-color: #4a69bd;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header-box .logo-section {
      display: flex;
      align-items: center;
    }

    .header-box img {
      width: 50px;
      height: 50px;
      margin-right: 10px;
    }

    .header-box h1 {
      color: white;
      font-size: 24px;
      margin: 0;
    }

    .header-box p {
      color: white;
      font-size: 14px;
      margin: 0;
    }

    /* User Info */
    .user-info {
      position: relative;
      display: inline-block;
    }

    .user-info span {
      color: white;
      margin-right: 10px;
      cursor: pointer;
    }

    .user-info i {
      font-size: 30px;
      color: white;
      cursor: pointer;
    }

    /* Dropdown Logout */
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      min-width: 120px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      z-index: 1050;
    }

    .dropdown-menu button {
      width: 100%;
      text-align: left;
      background: none;
      border: none;
      padding: 5px 0;
      color: #333;
      cursor: pointer;
    }

    .dropdown-menu button:hover {
      background-color: #f5f5f5;
    }

    /* Navbar dengan background biru */
    .navbar-custom {
      background-color: #4a69bd;
      padding: 10px 0;
      position: sticky;
      top: 0;
      z-index: 1000;
      width: 100%;
    }

    .navbar-nav .nav-link {
      font-size: 16px;
      color: white !important;
      margin-right: 30px;
    }

    /* Section Informasi Mahasiswa */
    .info-section {
      margin-top: 30px;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
    }

    .info-card {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .info-card h5 {
      font-weight: bold;
    }

    .progress-bar-container {
      margin-top: 20px;
    }

    .progress-bar-container .progress {
      height: 20px;
      border-radius: 10px;
    }

    .icon-large {
      font-size: 150px; /* Ukuran lebih besar */
      color: #4a69bd;
      margin-right: 20px; /* Memberi jarak antara ikon dan teks */
    }

    /* Footer fix di bawah */
    footer {
      background-color: #4a69bd;
      color: white;
      text-align: center;
      padding: 10px;
      margin-top: auto;
      width: 100%;
    }

    /* Responsive design untuk layar kecil */
    @media (max-width: 768px) {
      .info-section {
        grid-template-columns: 1fr;
        padding: 10px;
      }

      .icon-large {
        font-size: 100px; /* Ukuran ikon lebih kecil pada layar kecil */
      }

      .info-card {
        padding: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="wrapper">
    <!-- Header Box (Logo dan User) -->
    <div class="header-box">
      <div class="logo-section">
        <img src="{{ asset('assets/images/logo-finalease-removebg-preview.png') }}" alt="Logo">
        <div>
          <h1>FinalEase</h1>
          <p>Sistem Reminder Bimbingan TA</p>
        </div>
      </div>
      <div class="user-info" onclick="toggleDropdown()">
        <span>{{ Auth::user()->name }}</span>
        <i class="bi bi-person-circle"></i>
        <div class="dropdown-menu" id="dropdown-menu">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-danger">
              <i class="bx bx-power-off font-size-17 align-middle me-1 text-danger"></i> Logout
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pengajuan Jadwal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Jadwal Bimbingan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Schedule Tugas</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Section Informasi Mahasiswa dan Progress -->
    <div class="container info-section">
      <!-- Informasi Mahasiswa -->
      <div class="info-card">
        <div class="d-flex">
          <i class="bi bi-mortarboard icon-large"></i>
          <div class="ml-3">
            <h5>INFORMASI MAHASISWA</h5>
            <p>Hi, {{ Auth::user()->name }}</p>
            <p class="text-justify">
              Selamat datang di FinalEase, teman setia untuk membantu Tugas Akhir.
              Dengan FinalEase, bimbingan Tugas Akhir menjadi lebih mudah dan teratur.
            </p>            
          </div>
        </div>
      </div>

      <!-- Progress Tugas Akhir -->
      <div class="info-card">
        <h5>{{ Auth::user()->name }}</h5>
        <p>NIM: {{ Auth::user()->mahasiswa->nim }}</p>
        <p>Jurusan: {{ Auth::user()->mahasiswa->jurusan }}</p>
        <div class="progress-bar-container">
          <p>Bar Progress Tugas Akhir</p>
          <div class="progress">
            <div class="progress-bar bg-primary" style="width: 65%;">65%</div>
          </div>
        </div>
      </div>

      <div class="info-card-container" style="position: relative; border-radius: 5px; padding: 15px; background-color:white; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <div class="info-card" style="max-height: 350px; overflow-y: scroll;">
            @forelse ($bimbingans as $bmb)
                <h5>Pengajuan Jadwal Bimbingan</h5>
                <p>Tanggal Bimbingan: {{ $bmb->tanggal }}</p>
                <p>Waktu: {{ \Carbon\Carbon::createFromFormat('H:i:s', $bmb->jam)->format('H:i') }}</p>
                <p>Dosen: {{ $bmb->dosen->nama }}</p>
                <p>Mahasiswa: {{ $bmb->mahasiswa->nama }}</p>
                <p>Lokasi: {{ $bmb->lokasi }}</p>
                <p>Topik: {{ $bmb->topik }}</p>
                <p>Status: 
                    <button type="button" class="btn btn-sm text-white" 
                        style="pointer-events: none; background-color: 
                        {{ $bmb->status === 'setuju' ? '#28a745' : ($bmb->status === 'pending' ? '#ffc107' : '#dc3545') }};">
                        {{ $bmb->status }}
                    </button>
                </p>
                <hr>
            @empty
                <p>Tidak ada pengajuan jadwal bimbingan yang ditemukan.</p>
            @endforelse
        </div>
        <div class="fixed-footer" style="text-align: center; margin-top: 10px;">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Ajukan Bimbingan
            </button>
        </div>
    </div>

    <div class="info-card-container" style="position: relative; border-radius: 5px; padding: 15px; background-color:white; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
      <div class="info-card" style="max-height: 350px; overflow-y: scroll;">
          @forelse ($bimbingans as $bmb)
              <h5>Jadwal Bimbingan</h5>
              <p>Tanggal Bimbingan: {{ $bmb->tanggal }}</p>
              <p>Waktu: {{ \Carbon\Carbon::createFromFormat('H:i:s', $bmb->jam)->format('H:i') }}</p>
              <p>Dosen: {{ $bmb->dosen->nama }}</p>
              <p>Mahasiswa: {{ $bmb->mahasiswa->nama }}</p>
              <p>Lokasi: {{ $bmb->lokasi }}</p>
              <p>Topik: {{ $bmb->topik }}</p>
              <hr>
          @empty
              <p>Tidak ada jadwal bimbingan yang ditemukan.</p>
          @endforelse
      </div>
  </div>
    
    
    
    
    

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Pengajuan Bimbingan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <form action="{{ route('bimbingans.store') }}" method="POST">
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @csrf
                  <div class="form-group row mb-3 align-items-center">
                      <label for="tanggal" class="col-2 col-form-label">Tanggal</label>
                      <div class="col-10">
                          <input id="tanggal" name="tanggal"
                              type="date" class="form-control" required="required">
                      </div>
                  </div>
                  <div class="form-group row mb-3 align-items-center">
                      <label for="jam" class="col-2 col-form-label">Jam Bimbingan</label>
                      <div class="col-10">
                          <input id="jam" name="jam"
                              type="time" required="required" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row mb-3 align-items-center">
                      <label for="dosen_id" class="col-2 col-form-label">Nama Dosen</label>
                      <div class="col-10">
                          <select name="dosen_id" id="dosen_id" class="form-control">
                              <option value="" hidden>Pilih Dosen</option>
                              @foreach ($dosens as $dsn)
                                  <option value="{{ $dsn->id }}">{{ $dsn->nama }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="form-group row mb-3 align-items-center">
                      <label for="mahasiswa_id" class="col-2 col-form-label">Nama Mahasiswa</label>
                      <div class="col-10">
                          <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
                              <option value="" hidden>Pilih Mahasiswa</option>
                              @foreach ($mahasiswas as $mhs)
                                  <option value="{{ $mhs->id }}">{{ $mhs->nama }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="form-group row mb-3 align-items-center">
                      <label for="lokasi" class="col-2 col-form-label">Lokasi</label>
                      <div class="col-10">
                          <input id="lokasi" name="lokasi"
                              type="text" required="required" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row mb-3 align-items-center">
                      <label for="topik" class="col-2 col-form-label">Topik</label>
                      <div class="col-10">
                          <input id="topik" name="topik"
                              type="text" required="required" class="form-control">
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </form>
          </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Footer -->
    <footer>
      <p>By RPL_Nemo</p>
    </footer>
  </div>

  <script>
    // Toggle Dropdown Menu
    function toggleDropdown() {
      var dropdown = document.getElementById('dropdown-menu');
      if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
      } else {
        dropdown.style.display = 'block';
      }
    }

    // Close dropdown menu when clicking outside
    window.onclick = function(event) {
      if (!event.target.matches('.user-info') && !event.target.closest('.user-info')) {
        var dropdown = document.getElementById('dropdown-menu');
        if (dropdown.style.display === 'block') {
          dropdown.style.display = 'none';
        }
      }
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>