<?php 
 /***************************************************************************************
 * Team Name: OPA                                                                       *
 * Date: 22 Nov 2011                                                                    *
 * Version No: 2                                                                        * 																		*
 *                                                                       		*
 * File Name: riskController.php                                                        *
  ***************************************************************************************/

class RiskController extends IRSController {

    public function __construct($memberArr, $projectArr, $sessionArr) {
        parent::__construct('risk', $memberArr, $projectArr, $sessionArr);
    }

}
 
?>
