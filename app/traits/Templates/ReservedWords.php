<?php

namespace Traits\Templates;

trait ReservedWords
{

    /**
     * Get a list of custom defined reserved words for the event
     * 
     * @param string $event
     * @return array
     */
    public function customWords($event)
    {
        $result = [];

        /**
         * Load the information for the reserved words
         */
        $words = $this->services->load('ReservedWords')->getItemsByOptions(["event_name" => $event], false);

        /**
         * Itterate each of the items and collect the required information
         */
        foreach ($words as $word) :
            if (isset($word->word) && trim($word->word)) :
                $result[$word->word] = $word->value;
            endif;
        endforeach;

        return $result;
    }

    /**
     * Replace the account information for the template
     * 
     * @param string $text
     * @return string
     */
    public function replaceAccount($text)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'account-name' => '##ACCOUNT-NAME##',
            'account-email' => '##ACCOUNT-EMAIL##',
            'account-signature' => '##ACCOUNT-SIGNATURE##',
        ];

        /**
         * Load the information for the logged user and for the receiver
         */
        if ($this->session->has('authentication')) :
            $account = $this->services->load('Modules\Accounts\Accounts')->getItem($this->session->get('_account')['id']);
        else :
            $account = $this->services->load('Modules\Accounts\Accounts')->getItem($this->config->signatures->masters->user_real_id);
        endif;

        /**
         * Verify that the information was loaded properly
         */
        if (!$account || !isset($account->id) || !(int) $account->id) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Container for the signature
         */
        $signature = '';

        /**
         * Add the name to the signature
         */
        $signature .= '<div>' . trim(ucwords(strtolower($account->first_name . ' ' . $account->last_name))) . '</div>';

        /**
         * Add the position to the signature
         */
        if (isset($account->position) && $account->position && trim($account->position) !== "") :
            $signature .= '<div>' . $account->position . '</div>';
        endif;

        /**
         * Add the company and email
         */
        $signature .= '<div style="color: rgb(0, 107, 181);">The Access Masters Tour</div>';
        $signature .= '<div>' . $account->email . '</div>';
        // $signature .= '<div>Tel: ' . ((isset($account->phone_work) && $account->phone_work && trim($account->phone_work !== '')) ? $this->helpers->load('General')->format_phone($account->phone_work) : '+359 2 984 10 71') . '</div>';

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'account-name' => trim(ucwords(strtolower($account->first_name . ' ' . $account->last_name))),
            'account-email' => $account->email,
            'account-signature' => $signature,
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the answers related reserved words
     * @param string $text
     * @param \Model\Candidates $candidate
     * @param \Model\ScheduleDays $event
     * @param \Model\Template $template
     * @return type
     */
    public function replaceAnswers($text, $candidate, $event, $template = false)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'answers-1' => '$ANSWERS$',
            'answers-2' => '$ANSWERS1$',
            'answers-3' => '$ANSWERS2$',
            'answers-new-1' => '##ANSWERS##',
            'answers-new-2' => '##ANSWERS1##',
            'answers-new-3' => '##ANSWERS2##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !is_object($event)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'answers-1' => $this->_answers(3, $candidate->email, $event->id, $template),
            'answers-2' => $this->_answers(1, $candidate->email, $event->id, $template),
            'answers-3' => $this->_answers(2, $candidate->email, $event->id, $template),
            'answers-new-1' => $this->_answers(3, $candidate->email, $event->id, $template),
            'answers-new-2' => $this->_answers(1, $candidate->email, $event->id, $template),
            'answers-new-3' => $this->_answers(2, $candidate->email, $event->id, $template),
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Helper method to generate a confirmation links for one of the templates
     * 
     * @param int $group
     * @param string $email
     * @param int $event_id
     * @param object $template
     * @return string
     */
    private function _answers($group, $email, $event_id, $template = false)
    {
        switch ($group):
            case "0":
                $answers = $this->config->schedules->confirmation->answers;
                break;

            case "1":
                $answers = $this->config->schedules->confirmation->answers1;
                break;

            case "2":
                $answers = $this->config->schedules->confirmation->answers2;
                break;

            case "3":
                $answers = $this->config->schedules->confirmation->answers3;
                break;
        endswitch;

        /**
         * Return empty string if the answers list is empty
         */
        if (empty($answers)) :
            return '';
        endif;

        $result = '<div>
                    <ul>';

        /**
         * Itterate each of the answers to create a link for confirmation
         */
        foreach ($answers as $key => $answer) :
            $scheme = $this->request->getScheme();
            $domain = 'www.accessmasterstour.com';

            /**
             * Create an unique key for the candidate
             */
            $unique = $this->services->load('Candidates')->getCandidateKey($key, $email);

            /**
             * Create a link with all attributes required for confirmation
             */
            $link = $scheme . '://' . $domain . $this->url->get('registration/confirmations/attendance/' . $answer['action'] . '/' . $event_id . '/' . $email . '/' . $unique);

            /**
             * Attach the template code to the link
             */
            if (isset($template->template_code) && trim($template->template_code) !== "") :
                $link .= '/' . $template->template_code;
                $link .= '/#EvEBY3gS';
            else :
                $link .= '/null/#EvEBY3gS';
            endif;

            /**
             * Add the link to the list
             */
            $result .= '<li><a href="' . str_replace('CARE3/', '', $link) . '">' . $answer['label'] . '</a></li>';
        endforeach;

        $result .= '</ul></div>';

        return $result;
    }

    /**
     * Replace the candidate information for the template
     * 
     * @param string $text
     * @param object $candidate
     * @return string
     */
    public function replaceCandidate($text, $candidate)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'name' => '$NAME$',
            'first-name' => '$FIRSTNAME$',
            'last-name' => '$LASTNAME$',
            'candidate-first-name' => '$CANDIDATEFIRSTNAME$',
            'candidate-last-name' => '$CANDIDATELASTNAME$',
            'gender' => '$GENDER$',
            'mail' => '$MAIL$',
            'profile' => '$PROFILE$',
            'skype' => '##SKYPE##',
            'skype-link' => '##SKYPE-LINK##',
            'skype-account' => '##SKYPE-ACCOUNT##'
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Generate the gender of the candidate
         */
        $gender = '';

        if (isset($candidate->personal) && $candidate->personal && isset($candidate->personal->id) && (int) $candidate->personal->id && isset($candidate->personal->gender)) :
            if (trim(strtolower($candidate->personal->gender)) == 'female' || trim(strtolower($candidate->personal->gender)) == 'male') :
                $gender = (trim(($candidate->personal->gender)) == 'female') ? 'Ms.' : 'Mr.';
            elseif (trim(strtolower($candidate->personal->gender)) == 'mr' || trim(strtolower($candidate->personal->gender)) == 'ms') :
                $gender = ucwords($candidate->personal->gender) . '.';
            endif;
        endif;

        /**
         * Generate the name of the candidate
         */
        $values['name'] = trim($gender . ' ' . ucwords(strtolower(@$candidate->personal->last_name)) . ' ' . ucwords(strtolower(@$candidate->personal->first_name)));
        $values['last_name'] = ucwords(strtolower(@$candidate->personal->last_name));
        $values['first_name'] = ucwords(strtolower(@$candidate->personal->first_name));

        $values['profile'] = '<div>';
        $values['profile'] .= '     Your profile data:<br/><br/>';
        $values['profile'] .= '     Name: <strong>' . ucwords(strtolower(@$candidate->personal->first_name)) . '</strong><br/>';
        $values['profile'] .= '     Last name: <strong>' . ucwords(strtolower(@$candidate->personal->last_name)) . '</strong><br/>';
        $values['profile'] .= '     Date of birth: <strong>' . @$candidate->personal->birthday . '</strong><br/>';
        $values['profile'] .= '     Years of experience: <strong>' . $candidate->employment->work_experience . '</strong><br/>';
        $values['profile'] .= '</div>';

        /**
         * Generate the link for candidates to be able to add/change skype account
         */
        $values['skype-link'] = 'Add/change your skype account <a target="_blank" href="https://www.accessmasterstour.com/registration/skype/manage/' . $candidate->email . '">here</a>';

        /**
         * Generate the information for the skype
         */
        $values['skype-account'] = '<em>Your skype user name is:</em> <strong>' . $candidate->personal->skype . '</strong> - <span style="font-size: 0.8em">' . $values['skype-link'] . '</span>';

        /**
         * Verify that we have the skype or create notice for the missing value
         */
        if (!isset($candidate->personal->skype) || !$candidate->personal->skype || trim($candidate->personal->skype) == "") :
            $values['skype-account'] = '<strong>Your Skype username is missing on our system. We obligatory need it in order to organize your meetings. Please, provide it as soon as possible</strong> - <span style="font-size: 0.8em">' . $values['skype-link'] . '</span>';
        endif;

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'name' => $values['name'],
            'first-name' => $values['first_name'],
            'last-name' => $values['last_name'],
            'candidate-first-name' => $values['first_name'],
            'candidate-last-name' => $values['last_name'],
            'gender' => $gender,
            'mail' => trim(strtolower($candidate->email)),
            'profile' => $values['profile'],
            'skype' => $candidate->personal->skype,
            'skype-link' => $values['skype-link'],
            'skype-account' => $values['skype-account']
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the candidate information for the template
     * 
     * @param string $text
     * @param object $candidate
     * @return string
     */
    public function replaceCandidateNumber($text, $candidate)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'reg-num' => '##Reg Num##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'reg-num' => $candidate->id,
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the surveys information for the template
     * 
     * @param string $text
     * @return string
     */
    public function replaceSurveys($text, $candidate, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'survey-not-attended' => '##SURVEY-NOT-ATTENDED##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !is_object($event)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Generate auto login link to feedback form
         */
        $link = 'https://advnt.to/c/' . base64_encode(md5($candidate->email . $candidate->password));
        if (strpos(strtolower($event->event_name), 'online') === false) {
            $link .=  '/' . base64_encode('products/masters/events/feedbacks/' . (int) $event->id);
        } else {
            $link .= '/' .base64_encode('products/online/masters/events/feedbacks/' . (int) $event->id);
        }

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'survey-not-attended' => $link
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the reserved word for submit feedback link
     * 
     * @param string $text
     * @return string
     */
    public function _submit_feedback_link($text, $candidate, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'submit-feedback-link' => '##CANDIDATE_SUBMIT_FEEDBACK_LINK##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !is_object($event)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Set the domain for the link 
         */
        $hostname = 'https://candidate.adventgroup.net/products/masters/events/feedbacks/';

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'submit-feedback-link' => $hostname . (int) $event->id,
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the links to other platforms information for the template
     * 
     * @param string $text
     * @return string
     */
    public function _links_candidates($text, $candidate, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'candidate-platform-link' => '##CANDIDATE-PLATFORM-LINK##',
            'candidate-platform-feedack-link' => '##CANDIDATE-PLATFORM-FEEDBACK-LINK##'
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !is_object($event)) :
            return $this->clearWords($words, $result);
        endif;

        $link['home-link'] = 'https://advnt.to/c/' . base64_encode(md5($candidate->email . $candidate->password));

        $link['feedback-link'] = 'https://advnt.to/c/' . base64_encode(md5($candidate->email . $candidate->password));
        if (strpos(strtolower($event->event_name), 'online') === false) {
            $link['feedback-link'] .=  '/' . base64_encode('products/masters/events/feedbacks/' . (int) $event->id);
        } else {
            $link['feedback-link'] .= '/' .base64_encode('products/online/masters/events/feedbacks/' . (int) $event->id);
        }

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'candidate-platform-link' => '<a href="' . $link['home-link'] . '">' . $link['home-link'] . '</a>',
            'candidate-platform-feedback-link' => '<a href="' . $link['feedback-link'] . '">Submit Feedback</a>',
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the links to other platforms information for the template with the word HERE
     *
     * @param string $text
     * @return string
     */
    public function _links_candidates_here($text, $candidate)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'candidate-platform-here-link' => '##CANDIDATE-PLATFORM-HERE-LINK##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate)) :
            return $this->clearWords($words, $result);
        endif;

        $link = 'https://advnt.to/c/' . base64_encode(md5($candidate->email . $candidate->password));

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'candidate-platform-here-link' => '<a href="' . $link . '">HERE</a>',
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the links to other platforms information for the template
     * 
     * @param string $text
     * @return string
     */
    public function _links_connect($text, $candidate)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'connect-platform-link' => '##CONNECT-PLATFORM-LINK##',
        ];

        /**
         * Get user information from Advent CONNECT
         */
        $connect_user = $this->services->load('CONNECT_USERS\Users')->getItemsByOptions(['email' => $candidate->email], true);

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !isset($connect_user->id)) :
            return $this->clearWords($words, $result);
        endif;

        $link = 'https://advnt.to/a/' . base64_encode(md5($candidate->email . $connect_user->password)) . '/' . base64_encode('/dashboard/access-online');

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'connect-platform-link' => '<a href="' . $link . '">' . $link . '</a>',
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the links to other platforms information for the template with the word HERE
     *
     * @param string $text
     * @return string
     */
    public function _links_connect_here($text, $candidate)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'connect-platform-here-link' => '##CONNECT-PLATFORM-HERE-LINK##',
        ];

        /**
         * Get user information from Advent CONNECT
         */
        $connect_user = $this->services->load('CONNECT_USERS\Users')->getItemsByOptions(['email' => $candidate->email], true);

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !isset($connect_user->id)) :
            return $this->clearWords($words, $result);
        endif;

        $link = 'https://advnt.to/a/' . base64_encode(md5($candidate->email . $connect_user->password)) . '/' . base64_encode('/dashboard/access-online');

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'connect-platform-here-link' => '<a href="' . $link . '">HERE</a>',
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the un-subscribe information for the template
     * 
     * @param string $text
     * @return string
     */
    public function replaceUnsubscibe($text, $candidate)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'unsubscribe' => '##UNSUBSCRIBE##',
            'unsubscribe-link' => '##UNSUBSCRIBE-LINK##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate)) :
            return $this->clearWords($words, $result);
        endif;

        $link = 'https://candidate.adventgroup.net/accounts/preferences/communication/' . base64_encode($candidate->email);

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'unsubscribe' => 'You have received this email because you have subscribed to one of our events. Click <a href="' . $link . '">here</a> to change your email preferences or to unsubscribe from our emails.',
            'unsubscribe-link' => $link,
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the unsubscribe text by product
     * 
     * @param string $text
     * @return string
     */
    public function replaceUnsubscribeByProduct($text, $candidate)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'unsubscribe-masters' => '##Unsubscribe Masters##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate)) :
            return $this->clearWords($words, $result);
        endif;

        $html = '<div style="background-color: #ffffff; font-size: 11px; line-height: 14px; padding-bottom:10px; font-family: Calibri, Tahoma, sans-serif;"><center><em>You have received this email because you have  subscribed to %1$s <br>';
        $html .= 'To manage or cancel your email subscriptions,  please click <a href="https://candidate.adventgroup.net/accounts/preferences/communication/' . $candidate->email . '" >here </a></em><br/>';
        $html .= '<em>Regarding data protection: Please feel free to  contact our data protection officer: <a href="mailto:dpo@adventgroup.net">dpo@adventgroup.net</a></em><br>';
        $html .= '<em>and check <a href="%2$s">%2$s</a></em>';
        $html .= ' <em>for further information regarding our rules on  deleting data,</em><br>';
        $html .= '<em>transfering data or working with third parties  regarding your data.</em></center></div></br>';

        $products = [
            'masters' => ['name' => 'Access MASTERS', 'url' => 'https://www.accessmasterstour.com/privacy-policy'],
        ];

        foreach ($products as $key => $product) :
            $out[$key] = sprintf($html, $product['name'], $product['url']);
        endforeach;

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'unsubscribe-masters' => $out['masters'],
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the workshops related reserved words
     * 
     * @param string $text
     * @param \Model\Candidates $candidate
     * @param \Model\ScheduleDays $event
     * @return string
     */
    public function replaceFair($text, $candidate, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = ['#FAIR-SCHOOLS#', '$FAIR-SCHOOLS$', '#SCHOOLS_F#', '$SCHOOLS_F$'];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !is_object($event)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Load the information for the fair
         */
        $fair = $event->fair;

        /**
         * Verify that the information was loaded properly
         */
        if (!$fair || !isset($fair->id) || !(int) $fair->id) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Load the information for the candidate meetings
         */
        $filters = array('candidate_email' => $candidate->email, 'fair_id' => $event->fair->id, 'status' => '1', 'deleted' => array('operation' => 'IS NULL'));
        $meetings = $this->services->load('FairsCandidates')->getItemsByOptions($filters, false);

        $list = '';

        if ($meetings && count($meetings)) :
            $list .= '<div>
                        <ol>';

            foreach ($meetings as $meeting) :
                if (isset($meeting->school) && $meeting->school && isset($meeting->school->id) && (int) $meeting->school->id) :
                    $list .= '<li>
                                <a href="' . $meeting->school->page_link . '"><b>' . $meeting->school->school_name . '</b></a> 
                              </li>';
                endif;
            endforeach;

            $list .= '      </ol>
                        <div><small>(click on the school name to view the school profile)</small></div>
                    </div>';
        endif;

        /**
         * Replace the words with the meetings result
         */
        $result = str_replace($words, $list, $result);

        /**
         * Clear the remaining the reserved words and return the result
         */
        return $this->clearWords($words, $result);
    }

    /**
     * Replace the schedules related information
     * 
     * @param string $text
     * @param object $schedule
     * @return string
     */
    public function replaceSchedule($text, $schedule)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = array('$CITY$', '$COUNTRY$', '$TIME$');

        /**
         * Verify that the information is valid
         */
        if (!is_object($schedule)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Get the starting hour for the schedule
         */
        $timings = explode('-', $schedule->starting_hour_1);

        /**
         * Collect the values for the replacing ordered same as the $words
         */
        $replacing = array($schedule->city, $schedule->country, @$timings[0]);

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    public function replaceCandidateSchedule($text, $candidate, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = ['$ARRIVE$'];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !is_object($event)) return $this->clearWords($words, $result);

        $accepte = $this->services->load('Accepte')->getItemsByOptions(['a_nom' => $event->event_name, 'e_email' => $candidate->email], true);

        $time_arrival = '09:00';
        if ($accepte && isset($accepte->arrival_time) && !empty($accepte->arrival_time)) $time_arrival = $accepte->arrival_time;

        /**
         * Add the values to the list for replacing
         */
        $replacing = [$time_arrival];

        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the reserwed words for candidate online schedule
     * 
     * @param type $text
     * @param type $candidate
     * @param type $event
     * @param type $subscription
     * @param type $schedule_online
     */
    public function replaceCandidateScheduleOnline($text, $candidate, $event, $attending, $schedule_online)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'schools' => '##SCHOOLS-ONLINE##',
            'schedule-arrive' => '##SCHEDULEARRIVE-ONLINE##'
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !is_object($event) || !is_object($schedule_online)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Load the information for the schedule timeslot times
         */
        $timeslots_times = $this->services->load('Modules\Schedules\Online')->generateTimes($schedule_online);

        /**
         * Default time for the arrival, and schools container
         */
        $time = '09:00';

        /**
         * Container for the generated schools lists
         */
        $lists = ['schools' => ''];

        /**
         * Load the information for the timeslots ordered by the time Ascedenting
         */
        $timeslots = $this->services->load('Modules\Schedules\Online\Timeslots')->setOrdering('day ASC, timeslot ASC')->getItemsByOptions(['event_id' => $event->id, 'email' => $candidate->email, 'status' => 1, 'deleted' => ['operation' => 'IS NULL']], false);

        /**
         * Verify that the information was loaded properly
         */
        if ($timeslots && count($timeslots)) :
            /**
             * Get the first timeslot, the timeslots are ordered by their time and we will use the first time slot to select the arrival time
             */
            $first = $timeslots->getFirst();

            /**
             * Match the times from the timeslot
             */
            preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $timeslots_times['slots'][$first->timeslot], $times);

            /**
             * Verify that we have the information for the time
             */
            if ($times && count($times) && isset($times[0]) && trim($times[0]) !== "") :
                $time = $times[0];
            endif;

            $lists['schools'] .= '<ol style="margin: 0px 0px 10px 25px;">';

            /**
             * Itterate each of the timeslots to collect the schools
             */
            foreach ($timeslots as $timeslot) :
                if (!isset($timeslot->school) || !$timeslot->school || !isset($timeslot->school->id) || !(int) $timeslot->school->id) :
                    continue;
                endif;

                $school = $timeslot->school;

                /**
                 * Verify that the information was loaded properly
                 */
                if (!$school || !isset($school->id) || !(int) $school->id) :
                    continue;
                endif;

                /**
                 * Create a date object for the timeslot using the default server timezone
                 */
                $date['object'] = new \DateTime((new \DateTime($event->event_date))->format('Y-m-d') . ' ' . @trim(@explode('-', @$timeslots_times['slots'][$timeslot->timeslot])[0]) . ':00');

                /**
                 * Add additional days depending on the day of the timeslot
                 */
                $date['object']->add(new \DateInterval('P' . (string) ((int) $timeslot->day - 1) . 'D'));

                /**
                 * A string value for the timeslot date and the notice
                 */
                $date['string'] = $date['object']->format('l, jS F') . ' at ' . $date['object']->format('H:i') . ' CET (Central European Time) - UTC/GMT +01 hours';

                $date['notice'] = 'We strongly advise you to review the school profiles, which you will find by clicking on the links above and to check your timezone ';
                $date['notice'] .= '<a target="_blank" href="http://www.timeanddate.com/worldclock/fixedtime.html?msg=Online+Event+Sessions&iso=' . $date['object']->format('Ymd') . 'T' . $date['object']->format('H') . '&p1=195">here</a>.';

                /**
                 * Calculate the timeslot time based on the candidate timezone
                 */
                if (isset($candidate->timezone) && $candidate->timezone && trim($candidate->timezone) !== "") :
                    /**
                     * Collect the information for the location
                     */
                    $location = array_map('trim', explode('/', $candidate->timezone));
                    $location = ucwords(str_replace('_', ' ', end($location)));

                    /**
                     * Conver the date object to the candidate timezone
                     */
                    $date['object'] = $this->helpers->load('Date')->convert_to_user_date($date['object'], $candidate->timezone);

                    /**
                     * Verify that the type of the object is correct
                     */
                    if ($date['object'] && $date['object'] instanceof \DateTime) :
                        $date['string'] = $date['object']->format('l, jS F') . ' at ' . $date['object']->format('H:i') . ' (your local time)';
                        $date['notice'] = 'We strongly advise you to review the school profiles, which you will find by clicking on the links above';
                    endif;
                endif;

                /**
                 * Generate the information for the school and the meeting time and date
                 */
                $lists['schools'] .= '<li>
                        <a href="' . $school->page_link . '">' . $school->school_name . '</a>
                        <span style="font-size:0.75em; font-weight:normal;">
                            ' . (isset($this->config->programs->categories[$timeslot->school_program]) ? '(' . $this->config->programs->categories[$timeslot->school_program] . ')' : '') . '
                            - <strong>' . $date['string'] . '</strong>
                            <br/>
                            
                            <span style="font-size:0.7em;">                                
                                (click on the school name to view the online school booth)
                            </span>                                                        
                        </span>
                        
                        <div style="font-size: 12px; font-weight: normal;">
                            <a href="https://www.accessmasterstour.com/registration/confirmations/online/1/' . $timeslot->id . '/' . $candidate->email . '/' . $this->helpers->load('Candidate')->key($candidate->email, 1) . '">
                                Yes, I will be online to meet this school’s representative at the suggested time
                            </a>
                            
                            <br/>

                            <a href="https://www.accessmasterstour.com/registration/confirmations/online/2/' . $timeslot->id . '/' . $candidate->email . '/' . $this->helpers->load('Candidate')->key($candidate->email, 2) . '">
                                Yes, I am willing to meet this school, but I would like to change the time of this meeting
                            </a>
                            
                            <br/>

                            <a href="https://www.accessmasterstour.com/registration/confirmations/online/30/' . $timeslot->id . '/' . $candidate->email . '/' . $this->helpers->load('Candidate')->key($candidate->email, 30) . '">
                                No, I do not want to meet with this school
                            </a>
                        </div>
                    </li>';
            endforeach;

            $lists['schools'] .= '</ol>';
            $lists['schools'] .= '<div>' . @$date['notice'] . '</div>';
        endif;

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'schools' => $lists['schools'],
            'schedule-arrive' => date('H:i', strtotime($time) - (30 * 60))
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the workshops related reserved words
     * 
     * @param string $text
     * @param \Model\Candidates $candidate
     * @param \Model\ScheduleDays $event
     * @return string
     */
    public function replaceWorshop($text, $candidate, $event)
    {
        $result = $text;
        $parameters = array();

        /**
         * List of reserved words
         */
        $words = array('$INTERVAL_WS$');

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !is_object($event)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Load the information for the workshop
         */
        $workshop = $this->services->load('Workshops')->getWorkshopByEvent($event->event_name);

        /**
         * Verify that the information was loaded properly
         */
        if (!$workshop || !isset($workshop->id) || !(int) $workshop->id) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Collect the information for the workshop periods
         */
        if (isset($workshop->periods) && !empty($workshop->periods)) :
            foreach ($workshop->periods as $period) :
                $parameters['periods'][$period->period_id] = $period->start_time;
            endforeach;
        endif;

        /**
         * Default value for the period
         */
        $period = count($workshop->periods);

        /**
         * Load the information for the tables
         */
        $tables = $this->services->load('WorkshopTables')->getWorkshopTablesByCandidateAndEvent($candidate->email, $event->event_name);

        if (count($tables)) :
            /**
             * Itterate each of the tables and collect the lowest period
             */
            foreach ($tables as $table) :
                if ((int) @$table->table->period_id && (int) @$table->table->period_id < $period) :
                    $period = (int) @$table->table->period_id;
                endif;
            endforeach;
        else :
            $period = 1;
        endif;

        /**
         * Collect the information for the period time
         */
        $time = @$parameters['periods'][$period];

        /**
         * Verify that the information was loaded properly
         */
        if ($time && trim($time) !== "") :
            $interval = date("H:i", strtotime('-40  minutes', strtotime($time))) . ' - ' . date("H:i", strtotime('-10  minutes', strtotime($time)));

            $result = str_replace('$INTERVAL_WS$', $interval, $result);
        endif;

        /**
         * Clear the remaining the reserved words and return the result
         */
        return $this->clearWords($words, $result);
    }

    /**
     * Replace the reserwed words for QR
     * 
     * @param string $text
     * @param object $candidate
     * @param object $event
     * @return string
     */
    public function replaceCandidateQR($text, $candidate, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = ['$CANDIDATE-QR$', '$CANDIDATE_QR$', '##CANDIDATE-QR##', '##CANDIDATE_QR##'];

        /**
         * Verify that the information is valid
         */
        if (!is_object($candidate) || !is_object($event)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * String that will by used for the QR code
         */
        $string = trim($event->event_name . ';masters;' . $candidate->email);

        /**
         * Container for the content of the QR code
         */
        $QR = '';

        /**
         * Create the QR or load existing QR code
         */
        $source = $this->helpers->load('QR')->customText($string, false, ['size' => 3]);

        /**
         * Generate the full url for our sources, 
         * we will use this to generate links for images, metatags ..
         */
        $hostname = $this->request->getScheme() . '://' . $this->request->getHttpHost();

        /**
         * Verify that the source exists
         */
        if ($source && file_exists($source) && is_file($source)) :
            $QR = '<img src="' . $hostname . '/CARE3/' . str_replace(realpath(APP_PATH . '../') . '/', '', $source) . '" style="max-height:100px;" />';
        endif;

        /**
         * Replace the words with the values
         */
        return str_replace($words, $QR, $result);
    }

    /**
     * Replace the reserwed words for school answers
     * 
     * @param string $text
     * @param object $school
     * @param object $event
     * @return string
     */
    public function replaceSchoolAnswers($text, $school, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'answers-oto-reminder' => '##SCHOOLS_ANSWERS_OTO_REM##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($school) || !is_object($event)) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Container for the answers
         */
        $answers = ['oto-reminder' => ''];

        /**
         * Verify that we have the confirmation URL
         */
        if (isset($this->config->schedules->schools_otoreminder_choice->url) && $this->config->schedules->schools_otoreminder_choice->url && isset($this->config->schedules->schools_otoreminder_choice->answers) && count($this->config->schedules->schools_otoreminder_choice->answers)) :
            /**
             * Itterate each of the answers to generate Links
             */
            foreach ($this->config->schedules->schools_otoreminder_choice->answers as $id => $answer) :
                /**
                 * Generate the key and the link for the action
                 */
                $key = $this->helpers->load('School')->school_key((string) $school->id, (int) $id);

                /**
                 * Create a link for the action
                 */
                $links[(int) $id] = $answer;
                //$links[(int) $id]['link'] = $this->config->schedules->confirmation->url . '?event=' . $event->event_name . '&amp;act=' . (int) $id . '&amp;email=' . $candidate->email . '&key=' . $key;
                $links[(int) $id]['link'] = $this->config->schedules->schools_otoreminder_choice->url . '/' . (int) $id . '/' . $event->id . '/' . $school->id . '/' . $key;
            endforeach;
        endif;

        /**
         * Verify that we have the information for the links
         */
        if (isset($links) && count($links)) :
            /**
             * Create the link list for "##SCHOOLS_ANSWERS_OTO_REM##"
             */
            $answers['oto-reminder'] .= '<ol>';

            foreach ([11, 12, 13] as $id) :
                if (isset($links[$id]['label-default']) && trim($links[$id]['label-default']) !== "" && isset($links[$id]['link']) && trim($links[$id]['link']) !== "") :
                    $answers['oto-reminder'] .= '<li><a href="' . $links[$id]['link'] . '">' . $links[$id]['label-default'] . '</a></li>';
                endif;
            endforeach;

            $answers['oto-reminder'] .= '</ol>';


        endif;

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'answers-oto-reminder' => $answers['oto-reminder'],
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the reserved words for Event Venue from Sales -> Events
     * 
     * @param string $text
     * @param object $event
     * @return string
     */
    public function replaceEventVenue($text, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'event_venue' => '##SCHOOLS_EVENT_VENUE##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($event) || (int) $event->id == 0 || (int) @$event->sales_details_venue->id == 0) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Container for the content
         */
        $out = '';
        $out .= '<div>';
        $out .= trim(@$event->sales_details_venue->description);
        $out .= '</div>';

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'event_venue' => $out,
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the reserved words for Event SSchedule from Sales -> Events
     * 
     * @param string $text
     * @param object $event
     * @return string
     */
    public function replaceEventSchedule($text, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'event_schedule' => '##SCHOOLS_EVENT_SCHEDULE##'
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($event) || (int) $event->id == 0 || (int) @$event->sales_details_schedule->id == 0) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Container for the content
         */
        $out = '';
        $out .= '<div>';
        $out .= trim(@$event->sales_details_schedule->description);
        $out .= '</div>';

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'event_schedule' => $out,
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the reserved words for Set of all the countries from which the signed schools for an event are - Schedules/Schools - Countries
     * 
     * @param string $text
     * @param object $event
     * @return string
     */
    public function replaceEventSignedCountries($text, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'event_signed_countries' => '##SIGNED_SCHOOLS_COUNTRIES##',
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($event) || (int) $event->id == 0) :
            return $this->clearWords($words, $result);
        endif;

        /**
         * Load the information for the signed OTO Events Schools which have Confirmed
         */
        $school_names = $this->services->load('Modules\Schools\Schools')->getSigned((int) $event->id);

        /**
         * Load the information for the schools
         */
        $schools = $this->services->load('Schools')->getSchoolsByNames(array_unique(array_filter($school_names)));

        $countries = [];
        $countries_school = [];

        foreach ($schools as $school) :
            if (isset($school->school_country) && $school->school_country) :
                $ids = explode(',', $school->school_country);

                if (!empty($ids)) :
                    $countries_school[$school->id] = $this->services->load('SettingsCountries')->getCountriesByIDS($ids);
                endif;
            endif;
        endforeach;

        if (!isset($countries_school) || count($countries_school) == 0) :
            return $this->clearWords($words, $result);
        endif;

        foreach ($countries_school as $school_items) :
            if (count($school_items)) :
                foreach ($school_items as $country) :
                    if (isset($country->name)) :
                        $countries[trim($country->name)] = trim($country->name);
                    endif;
                endforeach;
            endif;

        endforeach;

        @ksort($countries);

        /**
         * Container for the content
         */
        $out = '';
        $out .= '<span>';
        $out .= trim(@implode(', ', $countries));
        $out .= '</span>';

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'event_signed_countries' => $out,
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the school information for the template
     * 
     * @param string $text
     * @param object $school
     * @param object $event
     * @return string
     */
    public function replaceSchoolSale($text, $school, $event, $sale)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'contact-name' => '$CONTACT_NAME$',
            'contact-name-alternative' => '#CONTACT_NAME#',
            'contact-email' => '$CONTACT_EMAIL$',
            'contact-email-alternative' => '#CONTACT_EMAIL#'
        ];

        /**
         * Verify that the information is valid
         */
        if (!is_object($school)) :
            return $this->clearWords($words, $result);
        endif;

        $contacts = ['names' => [], 'emails' => []];

        /**
         * Collect the names for the contacts
         */
        foreach (array_map('trim', explode(',', $sale->contact_name)) as $names) :
            foreach (array_map('trim', explode(';', $names)) as $name) :
                $contacts['names'][] = $name;
            endforeach;
        endforeach;

        /**
         * Collect the emails for the contacts
         */
        foreach (array_map('trim', explode(',', $sale->contact_email)) as $emails) :
            foreach (array_map('trim', explode(';', $emails)) as $email) :
                $contacts['emails'][] = $email;
            endforeach;
        endforeach;

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'contact-name' => @$contacts['names'][0],
            'contact-name-alternative' => @$contacts['names'][0],
            'contact-email' => @$contacts['emails'][0],
            'contact-email-alternative' => @$contacts['emails'][0]
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    /**
     * Replace the "Add to Calendar" buttons section reserved word
     * 
     * @param string $text
     * @param object $candidate
     * @param object $event
     * @return string
     */
    public function replaceAddToCalendar($text, $event)
    {
        if (is_object($event)) :
            $buttons = '';

            /**
             * Load the information for the event
             */
            $item = $event;

            /**
             * Verify that the information was loaded properly
             */
            if ($item && isset($item->id) && (int) $item->id) :
                /**
                 * Load the information for the event city
                 */
                $city = $this->services->load('Application\MASTERS\Modules\Settings\Cities')->getItemsByOptions(['name' => @$item->application_event->city], true);

                /**
                 * Default times for the ADD to Calendar
                 */
                $timings = ["start" => "09:00", "end" => "22:00"];

                /**
                 * Verify that we have the information for the schedule
                 */
                if (isset($item->schedule) && $item->schedule && isset($item->schedule->id) && $item->schedule->id && isset($item->schedule->starting_hour_1) && $item->schedule->starting_hour_1) :
                    $starting = explode('-', $item->schedule->starting_hour_1);

                    /**
                     * Verify the information for the starting time
                     */
                    if ($starting && count($starting) == 2) :
                        $timings['start'] = $starting[0];
                    endif;

                    /**
                     * Verify that we have the information for the amount & length of the timeslots
                     */
                    if ((int) @$item->schedule->timeslot_per_day * (int) @$item->schedule->timeslot_interval > 0) :
                        $timings['end'] = date('H:i', strtotime($timings['start']) + (@$item->schedule->timeslot_per_day * (int) @$item->schedule->timeslot_interval * 60));
                    endif;
                endif;

                /**
                 * Generate the message content that will be substituted
                 */
                $buttons = $this->view->getRender('templates', '_generated/emails/add-to-calendar', [
                    'item' => $item,
                    'city' => $city,
                    'timings' => $timings,
                ]);

            endif;

            $text = str_replace('$ADD_TO_CALENDAR$', @$buttons, $text);

        endif;

        return $text;
    }

    public function replaceOldDatabase($text, $candidate, $event)
    {
        $result = $text;

        /**
         * List of reserved words
         */
        $words = [
            'answers_old_data' => '$ANSWERS_OLDDATA$',
        ];

        /**
         * Verify that the information is valid
         */
        //        if (!is_object($candidate)):
        //            return $this->clearWords($words, $result);
        //        endif;

        $link = $this->request->getScheme() . '://www.accessmasterstour.com/registration/confirmations/oldDatabase/';

        /**
         * Add the values to the list for replacing
         */
        $replacing = [
            'answers_old_data' => '<a href="' . $link . '1/' . $event->id . '/' . $candidate->email . '">Yes, I am interested in attending the event</a><br />'
                . '<a href="' . $link . '0/' . $event->id . '/' . $candidate->email . '">No, I am not interested in attending the event</a>',
        ];

        /**
         * Replace the words with the values
         */
        return str_replace($words, $replacing, $result);
    }

    public function generatePDFLink($text, $event)
    {
        $words = [
            'pdf_link' => '##PDF-LINK##'
        ];

        $replacing = [
            'pdf_link' => '<a style="text-decoration: underline;" href="' . $this->config->application->url->candidate . 'products/masters/documents/view/' . $event->id . '" target="_blank">info pack</a>',
        ];

        return str_replace($words, $replacing, $text);
    }
}
