<?

function get_footer()
{
    return '
        <footer class="footer">
            <div class="container">
                <div class="footer__container">

              </div>
            </div>
        </footer>
    </div>
    <script>
        window.onload = () => {
            const loader = document.querySelector(".loader");

            if (!loader) return;

            loader.classList.add("_load");

            window.onload = null;
        }
    </script>
    <script src="/js/index.js" defer></script>
    </body>

    </html>
    ';
}
