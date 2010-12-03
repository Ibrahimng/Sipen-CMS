<?
  class CustomerPlan extends DatabaseObject
  {
    public function __construct()
    {
      // This is required or this constructor will override the
      // database object
      parent::__construct();
			$this->id = array();
			$this->planid = array();
			$this->startdate = array();
			$this->enddate = array();
			$this->scheduledclose = array();
			$this->lastbilling = array();
			$this->nextbilling = array();
    }

/*
		public function selectActivePlans($userid, $excludeScheduledClose = false)
		{
			$userid = esc($userid);
      $sql = "SELECT p.planid, p.description, p.shortname, p.monthlyprice,
        p.commission, p.inventorylimit, p.promocode, p.promoexpire,
        p.codeexpire, p.hidden, p.plancolor, p.cclink, p.ccunlink,
        p.transaction, cp.cxplanid, cp.userid, cp.startdate,
        cp.enddate, cp.scheduledclose, cp.lastbilling, cp.nextbilling
        FROM planoptions p, customerplans cp
        WHERE cp.planid = p.planid AND cp.enddate = '0000-00-00 00:00:00'
				AND cp.userid = '$userid'";
			if ($excludeScheduledClose)
				$sql .= " AND cp.scheduledclose = '0000-00-00'";
			$sql .= " ORDER BY p.priority";
			return $this->selectPlansFromDatabase($sql);
		}

		public function selectClosedPlans($userid)
		{
			$userid = esc($userid);
			$sql = "SELECT cxplanid, userid, planid, startdate, scheduledclose,
				lastbilling, nextbilling, enddate FROM customerplans
				WHERE userid = '$userid' AND enddate <> ''";
			return $this->selectPlansFromDatabase($sql);
		}

		protected function selectPlansFromDatabase($sql)
		{
			$totalFound = 0;
			$sqlResult = database($sql);
			if ($sqlResult)
      {
        while ($r = mysql_fetch_assoc($sqlResult))
        {
          $this->cxplanid[] = $r['cxplanid'];
					$this->userid[] = $r['userid'];
					$this->planid[] = $r['planid'];
					$this->startdate[] = $r['startdate'];
					$sclose = $r['scheduledclose'];
					if ($sclose == '0000-00-00')
						$sclose = '';
					$this->scheduledclose[] = $sclose;
					$this->lastbilling[] = $r['lastbilling'];
					$this->nextbilling[] = $r['nextbilling'];
					$this->enddate[] = $r['enddate'];
					$this->description[] = $r['description'];
          $this->shortname[] = stripslashes($r['shortname']);
          $this->monthlyprice[] = $r['monthlyprice'];
          $this->commission[] = $r['commission'];
          $this->inventorylimit[] = $r['inventorylimit'];
          $this->promocode[] = $r['promocode'];
          $this->promoexpire[] = $r['promoexpire'];
          $this->promoexpire[] = $r['promoexpire'];
          $this->hidden[] = $r['hidden'];
          $this->plancolor[] = stripslashes($r['plancolor']);
          $this->cclink[] = stripslashes($r['cclink']);
          $this->ccunlink[] = stripslashes($r['ccunlink']);
          $this->transaction[] = stripslashes($r['transaction']);
        }
				$totalFound = mysql_num_rows($sqlResult);
        mysql_free_result($sqlResult);
      }
			return $totalFound;
		}

		public function scheduledClosePlan($userid, $cxplanid = '')
		{
			$userid = esc($userid);
			$cxplanid = esc($cxplanid);
			$sql = "UPDATE customerplans SET scheduledclose = nextbilling " .
				"WHERE userid = '$userid' AND enddate = '0000-00-00 00:00:00' " .
				" AND scheduledclose = '0000-00-00'";
			if ($cxplanid)
				$sql .= " AND cxplanid = '$cxplanid'";
			database($sql);
			$this->recordTransaction($userid, $cxplanid);
		}
*/
  }
?>
