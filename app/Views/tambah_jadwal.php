<div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">

            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">

              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">

              <li class="nav-item dropdown">

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">

                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
        <div class="page-heading">
          <div class="page-title">
            <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Jadwal</h3>
              </div>
              
            </div>
          </div>
          <section id="basic-horizontal-layouts">
            <div class="row match-height">
              <div class="col-md-6 col-12">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                    <form class="form-horizontal form-label-left" novalidate action="<?= base_url('Home/aksi_tambah_jadwal')?>" method="post" enctype="multipart/form-data">
                      <form class="form form-horizontal">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-4">
                              </div>

                              <label for="first-name-horizontal"
                                >Nama Tempat</label
                              >
                            <div class="col-md-8 form-group">
                              <input
                                type="text"
                                id="first-name-horizontal"
                                class="form-control"
                                name="tempat"
                                placeholder="Nama Tempat Parttime"
                              />
                            </div>
                            <label for="first-name-horizontal"
                                >Tanggal</label
                              >
                            <div class="col-md-8 form-group">
                              <input
                                type="date"
                                id="first-name-horizontal"
                                class="form-control"
                                name="tanggal"
                                placeholder="Tanggal Parttime"
                              />
                            </div>
                           <!--  <label for="first-name-horizontal"
                                >Umur</label
                              >
                            <div class="col-md-8 form-group">
                              <input
                                type="text"
                                id="first-name-horizontal"
                                class="form-control"
                                name="umur"
                                placeholder="Umur"
                              />
                            </div> -->
                            <div class="col-sm-12 d-flex justify-content-end">
                              <button
                                type="submit"
                                class="btn btn-primary me-1 mb-1"
                              >
                                Submit
                              </button>
                              <button
                                type="reset"
                                class="btn btn-light-secondary me-1 mb-1"
                              >
                                Reset
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
      