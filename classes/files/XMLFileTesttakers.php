<?php
/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);


class XMLFileTesttakers extends XMLFile {

    private function getCodesFromBookletElement(SimpleXMLElement $bookletElement) {

        $myreturn = [];
        if ($bookletElement->getName() == 'Booklet') {
            $codesAttr = $bookletElement['codes'];
            if (isset($codesAttr)) {
                $codes = (string) $codesAttr;
                if (strlen(trim($codes)) > 0) {
                    foreach(explode(' ', $codes) as $c) {
                        if (strlen($c) > 0) {
                            if (!in_array($c, $myreturn)) {
                                array_push($myreturn, $c);
                            }
                        }
                    }
                }
            }
        }
        return $myreturn;
    }


    // ['groupname' => string, 'loginname' => string, 'code' => string, 'booklets' => string[]]
    public function getAllTesttakers() {
        $myreturn = [];

        if ($this->_isValid and ($this->xmlfile != false) and ($this->_rootTagName == 'Testtakers')) {
            $allLoginNames = []; // double logins are ignored
            foreach($this->xmlfile->children() as $groupNode) {

                if ($groupNode->getName() == 'Group') {

                    $groupnameAttr = $groupNode['name'];

                    if (isset($groupnameAttr)) {

                        $groupname = (string) $groupnameAttr;

                        foreach($groupNode->children() as $loginNode) {

                            if ($loginNode->getName() == 'Login') {

                                $loginNameAttr = $loginNode['name'];

                                if (isset($loginNameAttr)) {

                                    $loginName = (string) $loginNameAttr;

                                    if (!in_array($loginName, $allLoginNames)) {
                                        array_push($allLoginNames, $loginName);

                                        if (strlen($loginName) > 2) {

                                            // only valid logins are taken //////////////////////////////////
                                            
                                            // collect all codes
                                            $allCodes = [];
                                            foreach($loginNode->children() as $bookletElement) {
                                                if ($bookletElement->getName() == 'Booklet') {
                                                    foreach($this->getCodesFromBookletElement($bookletElement) as $c) {
                                                        if (!in_array($c, $allCodes)) {
                                                            array_push($allCodes, $c);
                                                        }
                                                    }
                                                }
                                            }

                                            // collect booklets per code and booklets with no code
                                            $noCodeBooklets = [];
                                            $codeBooklets = []; // key: code, value: bookletName[]
                                            foreach($loginNode->children() as $bookletElement) {
                                                if ($bookletElement->getName() == 'Booklet') {
                                                    $bookletName = strtoupper(trim((string) $bookletElement));
                                                    if (strlen($bookletName) > 0) {
                                                        $myCodes = $this->getCodesFromBookletElement($bookletElement);
                                                        if (count($myCodes) > 0) {
                                                            foreach($myCodes as $c) {
                                                                if (!isset($codeBooklets[$c])) {
                                                                    $codeBooklets[$c] = [];
                                                                }
                                                                if (!in_array($bookletName, $codeBooklets[$c])) {
                                                                    array_push($codeBooklets[$c], $bookletName);
                                                                }
                                                            }
                                                        } else {
                                                            if (!in_array($bookletName, $noCodeBooklets)) {
                                                                array_push($noCodeBooklets, $bookletName);
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            if (count($codeBooklets) > 0) {
                                                if (count($noCodeBooklets) > 0) {
                                                    // add all no-code-booklets to every code
                                                    foreach($codeBooklets as $code => $booklets) {
                                                        foreach($noCodeBooklets as $booklet) {
                                                            if (!in_array($booklet, $codeBooklets[$code])) {
                                                                array_push($codeBooklets[$code], $booklet);
                                                            }
                                                        }
                                                    }
                                                }
                                                foreach($codeBooklets as $code => $booklets) {
                                                    array_push($myreturn, [
                                                        'groupname' => $groupname,
                                                        'loginname' => $loginName,
                                                        'code' => $code,
                                                        'booklets' => $booklets
                                                    ]);
                                                }
                                            } else {
                                                if (count($noCodeBooklets) > 0) {
                                                        array_push($myreturn, [
                                                        'groupname' => $groupname,
                                                        'loginname' => $loginName,
                                                        'code' => '',
                                                        'booklets' => $noCodeBooklets
                                                    ]);
                                                }
                                            }
                                            // //////////////////////////////////////////////////////////////
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $myreturn;
    }


    public function getDoubleLoginNames() {

        $myreturn = [];
        if ($this->_isValid and ($this->xmlfile != false) and ($this->_rootTagName == 'Testtakers')) {
            $allLoginNames = [];
            foreach($this->xmlfile->children() as $groupNode) {
                if ($groupNode->getName() == 'Group') {
                    $groupnameAttr = $groupNode['name'];
                    if (isset($groupnameAttr)) {

                        foreach($groupNode->children() as $loginNode) {
                            if ($loginNode->getName() == 'Login') {
                                $loginNameAttr = $loginNode['name'];
                                if (isset($loginNameAttr)) {
                                    $loginName = (string) $loginNameAttr;
                                    if (!in_array($loginName, $allLoginNames)) {
                                        array_push($allLoginNames, $loginName);
                                    } else {
                                        if (!in_array($loginName, $myreturn)) {
                                            array_push($myreturn, $loginName);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $myreturn;
    }


    public function getAllLoginNames() {
        $myreturn = [];
        if ($this->_isValid and ($this->xmlfile != false) and ($this->_rootTagName == 'Testtakers')) {
            foreach($this->xmlfile->children() as $groupNode) {
                if ($groupNode->getName() == 'Group') {
                    $groupnameAttr = $groupNode['name'];
                    if (isset($groupnameAttr)) {

                        foreach($groupNode->children() as $loginNode) {
                            if ($loginNode->getName() == 'Login') {
                                $loginNameAttr = $loginNode['name'];
                                if (isset($loginNameAttr)) {
                                    $loginName = (string) $loginNameAttr;
                                    if (!in_array($loginName, $myreturn)) {
                                        array_push($myreturn, $loginName);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $myreturn;
    }


    public function getLoginData(string $givenLoginName, string $givenPassword, int $workspaceId): ?PotentialLogin {

        if ($this->_isValid and ($this->xmlfile != false) and ($this->_rootTagName == 'Testtakers')) {
            foreach($this->xmlfile->children() as $groupNode) {
                if ($groupNode->getName() == 'Group') {
                    $groupnameAttr = $groupNode['name'];

                    if (isset($groupnameAttr)) {
                        $groupname = (string) $groupnameAttr;

                        $validFrom = TimeStamp::fromXMLFormat((string) $groupNode['validFrom']);
                        $validTo = isset($groupNode['validTo']) ? TimeStamp::fromXMLFormat((string) $groupNode['validTo']) : 0;
                        $validForMinutes = (int) ($groupNode['validFor'] ?? 0);

                        foreach($groupNode->children() as $loginNode) {
                            if ($loginNode->getName() == 'Login') {
                                $loginNameAttr = $loginNode['name'];
                                $loginPwAttr = $loginNode['pw'] ?? '';
                                $mode = (string) $loginNode['mode'] ?? 'run-hot-return';
                                if (isset($loginNameAttr) and isset($loginPwAttr)) {
                                    $loginName = (string) $loginNameAttr;
                                    if ((strlen($loginName) > 2) and ($loginName == $givenLoginName)) {
                                        $loginPw = (string) $loginPwAttr;
                                        if ($loginPw == $givenPassword) {
   
                                            // collect all codes
                                            $allCodes = [];
                                            foreach($loginNode->children() as $bookletElement) {
                                                if ($bookletElement->getName() == 'Booklet') {
                                                    foreach($this->getCodesFromBookletElement($bookletElement) as $c) {
                                                        if (!in_array($c, $allCodes)) {
                                                            array_push($allCodes, $c);
                                                        }
                                                    }
                                                }
                                            }

                                            // collect booklets per code and booklets with no code
                                            $noCodeBooklets = [];
                                            $codeBooklets = []; // key: code, value: bookletName[]
                                            foreach($loginNode->children() as $bookletElement) {
                                                if ($bookletElement->getName() == 'Booklet') {
                                                    $bookletName = strtoupper(trim((string) $bookletElement));
                                                    if (strlen($bookletName) > 0) {
                                                        $myCodes = $this->getCodesFromBookletElement($bookletElement);
                                                        if (count($myCodes) > 0) {
                                                            foreach($myCodes as $c) {
                                                                if (!isset($codeBooklets[$c])) {
                                                                    $codeBooklets[$c] = [];
                                                                }
                                                                if (!in_array($bookletName, $codeBooklets[$c])) {
                                                                    array_push($codeBooklets[$c], $bookletName);
                                                                }
                                                            }
                                                        } else {
                                                            if (!in_array($bookletName, $noCodeBooklets)) {
                                                                array_push($noCodeBooklets, $bookletName);
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            if (count($codeBooklets) > 0) {
                                                if (count($noCodeBooklets) > 0) {
                                                    // add all no-code-booklets to every code
                                                    foreach($codeBooklets as $code => $booklets) {
                                                        foreach($noCodeBooklets as $booklet) {
                                                            if (!in_array($booklet, $codeBooklets[$code])) {
                                                                array_push($codeBooklets[$code], $booklet);
                                                            }
                                                        }
                                                    }
                                                }


                                                return new PotentialLogin(
                                                    $loginName,
                                                    $mode,
                                                    $groupname,
                                                    $codeBooklets,
                                                    $workspaceId,
                                                    $validTo,
                                                    $validFrom,
                                                    $validForMinutes,
                                                    $this->getCustomTexts()
                                                );
                                            } else {
                                                return new PotentialLogin(
                                                    $loginName,
                                                    $mode,
                                                    $groupname,
                                                    ['' => $noCodeBooklets],
                                                    $workspaceId,
                                                    $validTo,
                                                    $validFrom,
                                                    $validForMinutes,
                                                    $this->getCustomTexts()
                                                );
                                            }

                                            // //////////////////////////////////////////////////////////////
                                        }
                                        break; // abort also if the given password is incorrect
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return null;
    }
}
