
<!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
    </td>
  </tr>
  <tr>
    <td colspan="2" height="30"><hr /><br />
    <?php
        echo $version;
        if($_ENV['engineering mode'] == True) {
            echo ', <a href="history.txt">History of changes</a>';
        }
    ?>
    </td><br />
  </tr>
</table>
</body>
</html>