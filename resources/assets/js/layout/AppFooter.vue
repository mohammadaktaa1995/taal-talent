<template>
    <footer class="footer has-cards">

        <div class="container">
            <div class="row row-grid align-items-center my-md">
                <div class="col-lg-6">
<!--                    <h3 class="text-primary font-weight-light mb-2">-->
                        <img src="/img/logo_mini.png" alt="">
<!--                    </h3>-->
                    <p class="mb-0 font-weight-light">We zijn altijd telefonisch te bereiken op: 06 84 73 74 99 of 06 48
                        06 80 52
                        Liever even mailen? Mail dan naar: info@taal-talent.nl</p>
                </div>
                <div class="col-lg-6 btn-wrapper">
                    <div class="">
                        <p><b>Locaties</b></p>
                        <p>
                            Taal Talent<br>Vondellaan 4D<br>3141 TL Maassluis</p>
                        <p>
                            Tel: +31 (0) 6 84 73 74 99<br>
                            Tel: +31 (0) 6 48 06 80 52
                        </p>

                        <p>
                            <a target="_blank" rel="noopener" href="https://facebook.com/taaltalentonline/"
                               class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip"
                               data-original-title="Like us">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                            <a target="_blank" rel="noopener" href="https://www.instagram.com/taal_talent"
                               class="btn btn-neutral btn-icon-only btn-dribbble btn-round btn-lg" data-toggle="tooltip"
                               data-original-title="Like us">
                                <i class="fa fa-instagram"></i>
                            </a>

                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row align-items-center justify-content-md-between">
                <div class="col-md-6">
                    <div class="copyright">
                        &copy; {{year}}
                        <a href="http://taal-talent.nl/" target="_blank" rel="noopener">Taal Talent. Alle rechten
                            voorbehouden</a>.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
    export default {
        name: 'app-footer',
        data() {
            return {
                year: new Date().getFullYear()
            }
        }
    };
</script>
<style>
</style>
