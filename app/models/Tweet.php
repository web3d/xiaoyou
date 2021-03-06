<?php
class Tweet extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public function getProfile()
  {
    return new Profile($this->getProfileId());
  }
  
  public function getComments()
  {
    return fRecordSet::build('TweetComment', array('tweet_id=' => $this->getId()), array('timestamp' => 'asc'));
  }
  
  public function getReplyTimestamp()
  {
    $comments = $this->getComments()->getRecords();
    if ($n = count($comments)) {
      return $comments[$n - 1]->getTimestamp();
    }
    return $this->getTimestamp();
  }
}
