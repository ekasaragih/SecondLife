<footer class="footer pt-3  ">
    {{-- <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.linkedin.com/in/ekasaragih/" class="font-weight-bold" target="_blank">Eka
                        Parima Saragih </a>
                    for Final Project.
                </div>
            </div>
        </div>
    </div> --}}
    <div className='relative shadow-lg bg-neutral'>
        <div className='absolute inset-x-0 top-0 h-2 bg-gradient-to-b from-gray-200 via-transparent'></div>
        <div className='grid place-items-center relative z-10'>
            <div className='grid w-4/5'>
                <div className='flex flex-row space-x-4'>
                    <div className='flex flex-col flex-grow w-[20rem] text-left'>
                        <p className='mt-7 text-left'>
                            <b className='text-xl font-bold text-secondary'>@</b>
                            <b className='text-xl font-bold text-primary tracking-wide'>Ngontenin</b>
                        </p>
                        <p className='text-black font-bold text-left'>connecting customer with creator.</p>

                        <div className='mt-5'>
                            <div className='flex flex-row mt-5 space-x-4'>
                                <div className='flex flex-col flex-grow max-w-[25rem] text-left'>
                                    <p className='text-base text-primary'>PT. NGONTENIN JAYA</p>
                                    <p className='text-sm font-light mt-3 text-black'>
                                        Jl. Kp. Dusun Cibeber 1 No.50, Simpangan, Cikarang Utara, Bekasi Regency, West
                                        Java
                                        17530
                                    </p>
                                    <p className='text-sm font-light text-black'>081234567890</p>
                                </div>

                                <div className='flex flex-col flex-grow max-w-[20rem] text-left'>
                                    <p className='text-base text-primary'>NGONTENIN</p>
                                    <p className='text-sm mt-3 text-black'>Tentang</p>
                                    <p className='text-sm text-black'>Karir</p>
                                    <p className='text-sm text-black'>Kerjasama</p>
                                    <p className='text-sm text-black'>Blog</p>
                                </div>

                                <div className='flex flex-col flex-grow max-w-[20rem] text-left'>
                                    <p className='text-base text-primary'>PRODUK</p>
                                    <p className='text-sm mt-3 text-black'>E-learning</p>
                                    <p className='text-sm text-black'>Mentoring</p>
                                    <p className='text-sm text-black'>Jasa Talent</p>
                                </div>

                                <div className='flex flex-col flex-grow max-w-[20rem] text-left'>
                                    <p className='text-base text-primary'>LAINNYA</p>
                                    <p className='text-sm mt-3 text-black'>Syarat dan Ketentuan</p>
                                    <p className='text-sm text-black'>Ketentuan Privasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class='h-px my-5 bg-gray-200 border-0 dark:bg-gray-700'>
                </hr>

                <div className='flex justify-between mt-3 mb-7 text-secondary'>
                    <div className='text-left space-x-3'>
                        <span>
                            <Twitter />
                        </span>
                        <span>
                            <Instagram />
                        </span>
                        <span>
                            <YouTube />
                        </span>
                    </div>
                    <div className='text-right'>
                        <p>© {currentYear} Ngontenin. Hak cipta dilindungi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    const currentYear = new Date().getFullYear();
</script>