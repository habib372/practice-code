<div id="printArea">
    <table>
        <tr>
            <td>
                <h1>Data</h1>
            </td>
        </tr>
    </table>
</div>

<a href="#" onclick="printDiv('printArea')" class="btn btn-md btn-primary">Print</a>

            <script type="text/javascript">
              function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
              }
            </script>