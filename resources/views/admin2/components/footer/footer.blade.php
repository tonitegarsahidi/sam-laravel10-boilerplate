
        <!-- partial:partials/_footer.html -->
        <footer>
            <div class="mdc-layout-grid">
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                  <span class="text-center text-sm-left d-block d-sm-inline-block tx-14">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">samToni </a>2023</span>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex justify-content-end">
                  <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center tx-14">Free <a href="https://www.bootstrapdash.com/material-design-dashboard/" target="_blank"> material admin </a> dashboards from Bootstrapdash.com</span>
                </div>
              </div>
            </div>
          </footer>
          <!-- partial -->
        </div>
      </div>
    </div>
    <!-- plugins:js -->
    <script src={{ asset("assets/vendors/js/vendor.bundle.base.js") }}></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src={{ asset("assets/vendors/chartjs/Chart.min.js") }}></script>
    <script src={{ asset("assets/vendors/jvectormap/jquery-jvectormap.min.js") }}></script>
    <script src={{ asset("assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js") }}></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src={{ asset("assets/js/material.js") }}></script>
    <script src={{ asset("assets/js/misc.js") }}></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src={{ asset("assets/js/dashboard.js") }}></script>
    <!-- End custom js for this page-->

    {{-- =========== THIS IS CODE IN AFTER FOOTER, BEFORE BODY CLOSING TAG ========= --}}
    @yield('footer-code')
    {{-- ============================================================================ --}}
  </body>
  </html>
