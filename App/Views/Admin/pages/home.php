<main class="content">
    <nav class="navbar navbar-expand border-bottom-0 px-3 border-bottom z-3 position-absolute w-100">
        <button class="btn" id="sidebar-toggle" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                        <img src="../../resources/images/header-logo.png" class="avatar img-fluid rounded" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="../logout" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <section id="hero" class="hero section">
        <div class="hero-bg">
            <img src="..\..\resources\images\dashboard_background.png" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up" class="">Chào mừng đến với trang Admin</h1>
                <p data-aos="fade-up" data-aos-delay="100" class="">Nơi quản lý dữ liệu trang web The-Coffee nhanh và hiệu quả nhất<br></p>
            </div>
        </div>
    </section>
</main>
<style>
    .hero {
        width: 100%;
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero .hero-bg img {
        position: absolute;
        inset: 0;
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
        filter: blur(1px);
    }

    .hero .hero-bg::before {
        content: "";
        background: color-mix(in srgb, var(--background-color), transparent 15%);
        position: absolute;
        inset: 0;
        z-index: 2;
    }

    .hero .container {
        position: relative;
        z-index: 3;
    }

    .hero h1 {
        color:  #ffad3d;
        margin: 0;
        font-size: 48px;
        font-weight: 700;
        line-height: 56px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7), 
                 2px 2px 4px rgba(0, 0, 0, 0.7), 
                 3px 3px 6px rgba(0, 0, 0, 0.7);
                
    }


    .hero p {
        color: #ffad3d;
        margin: 5px 0 30px 0;
        font-size: 30px;
        font-weight: 500;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7), 
                 2px 2px 4px rgba(0, 0, 0, 0.7), 
                 3px 3px 6px rgba(0, 0, 0, 0.7);
    }
</style>