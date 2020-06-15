<?php
class Validator
{
    public function validatePureString($name)
    {
        if (!preg_match("^[a-z'-]*$", $name)) {
            echo "The first name can contain only alphabetic " .
                "characters or - or '";
        }
        if (!empty($initial) && !preg_match("^[a-z]$", $initial)) {
            echo "The initial field must be empty or one character in length.";
        }
    }

    public function validatePureNumber($num)
    {
        if (!is_numeric($num))
            echo "Salary must be numeric";
        else
            // remove spaces and convert to an integer
            $salary = intval($_POST["salary"]);
        if (!preg_match("^[0-9]{1,3}[.][0-9]{2}$", $num))
            echo "Item price must be between US$0.00 and US$999.99, " .
                "and must include the cent amount.";
    }

    public function checkdob($birth_date)
    {
        if (empty($birth_date)) {
            print "The date of birth field cannot be blank.";
            return false;
        }
        // Check the format and explode into $parts
        elseif (!preg_match(
            "^([0-9]{2})/([0-9]{2})/([0-9]{4})$",
            $birth_date,
            $parts
        )) {
            echo "The date of birth is not a valid date in the
     format DD/MM/YYYY";
            return false;
        } elseif (!checkdate($parts[2], $parts[1], $parts[3])) {
            echo "The date of birth is invalid. Please check that the month is
     between 1 and 12, and the day is valid for that month.";
            return false;
        } elseif (
            intval($parts[3]) < 1902 ||
            intval($parts[3]) > intval(date("Y"))
        ) {
            echo "You must be alive to use this service.";
            return false;
        } else {
            $dob = mktime(0, 0, 0, $parts[2], $parts[1], $parts[3]);
            // Check whether the user is 18 years old.
            if ((float) $dob > (float) strtotime("-18years")) {
                echo "You must be 18+ years of age to use this service";
                return false;
            }
        }
        return true;
    }
    function checkemail($email)
    {
        // Check syntax
        $validEmailExpr = "^[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*" .
            "@[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*$";
        // Validate the email
        if (empty($email)) {
            print "The email field cannot be blank";
            return false;
        } elseif (!preg_match($validEmailExpr, $email)) {
            print "The email must be in the name@domain format.";
            return false;
        } elseif (strlen($email) > 30) {
            print "The email address can be no longer than 30 characters.";
            return false;
        } elseif (function_exists("getmxrr") && function_exists("gethostbyname")) {
            // Extract the domain of the email address
            $maildomain = substr(strstr($email, '@'), 1);
            if (!(getmxrr($maildomain, $temp) ||
                gethostbyname($maildomain) != $maildomain)) {
                print "The domain does not exist.";
                return false;
            }
        }
        return true;
    }

    // function checkMailDomain($domain, $type)
    // {
    //     // Create a DNS resolver, and look up an $type record for $domain
    //     $resolver = new Net_DNS_Resolver();
    //     $answer = $resolver->search($domain, $type);
    //     // Is there an answer record?
    //     if (isset($answer->answer))
    //         // Iterate through the answers
    //         foreach ($answer->answer as $ans)
    //             // If it's a $type answer, return true
    //             if ($ans->type == $type)
    //                 return true;
    //     return false;
    // }
    // Extract the domain of the email address
    // $maildomain = substr(strstr($email, '@'), 1);
    // if (!(checkMailDomain($maildomain, "MX") ||
    //  checkMailDomain($maildomain, "A")))
    //  {
    //  print "The domain does not exist.";
    //  return false;
    //  }
}
