<?
  class Plan extends DatabaseObject
  {
    public function __construct()
    {
      // This is required or this constructor will override the
      // database object
      parent::__construct();
    }

		public function validate()
		{
			if (is_array($this->name))
				return $this->validate_all();	
			$input = new Input();
      if ($this->hidden)
        $this->hidden = 1;
      else
        $this->hidden = 0;
     	$input->minMax($this->name, 1, 32, 'Plan Name');
      $input->minMax($this->description, 1, 64, 'Plan Description');
 	    $input->money($this->price, 'Plan Price');
   	  $input->digits($this->period, 'Monthly Period');
			$input->boolean($this->hidden, 'Hidden Option');
			if (!$this->plancolor)
				$this->plancolor = '#99cccc';
			$input->maximum($this->plancolor[$i], 32, 'Plan HTML Color Bar');
			return true;
		}

		public function monthlyFee($index = 0)
		{
			if (is_array($this->name))
			{
				if (!$this->price[$index]) return "No Charge";
				return "\$".$this->price[$index];
			}
			if (!$this->price) return "No Charge";
			return "\$".$this->price;
		}

		private function validate_all()
		{
			$input = new Input();
			$elements = count($this->name);
			for ($i = 0; $i < $elements - 1; $i++)
			{
	     	$input->minMax($this->name[$i], 1, 32, 'Plan Name');
	      $input->minMax($this->description[$i], 1, 64, 'Plan Description');
  	    $input->money($this->price[$i], 'Plan Price');
    	  $input->digits($this->period[$i], 'Monthly Period');
				$input->boolean($this->hidden[$i], 'Hidden Option');
				if (!$this->plancolor[$i])
					$this->plancolor[$i] = '#99cccc';
				$input->maximum($this->plancolor[$i], 32, 'Plan HTML Color Bar');
	      if ($this->hidden)
  	      $this->hidden = 1;
    	  else
      	  $this->hidden = 0;
			}
			return true;
		}


/*
		protected function selectPlansFromDatabase($sql)
		{
			// Note: We use $i = 0 to load the array instead of
			// [] in this because we want to be sure that the plans
			// that are selected here overwrite any previously loaded
			// plans.  This is still not good though because if you call
			// public plan loading then private, it will overwrite only
			// part of the private and will only load half of the public.
			// TODO: This should be fixed with a proper reset or some similar
			// resolution.
			$sqlResult = database($sql);
			if ($sqlResult)
			{
				$i = 0;
				while ($r = mysql_fetch_assoc($sqlResult))
				{
					$this->planid[$i] = $r['planid'];
					$this->description[$i] = stripslashes($r['description']);
					$this->shortname[$i] = stripslashes($r['shortname']);
					$this->monthlyprice[$i] = $r['monthlyprice'];
					$this->commission[$i] = $r['commission'];
					$this->inventorylimit[$i] = $r['inventorylimit'];
					$this->promocode[$i] = $r['promocode'];
					$this->promoexpire[$i] = $r['promoexpire'];
					$this->promoexpire[$i] = $r['promoexpire'];
					$this->hidden[$i] = $r['hidden'];
					$this->plancolor[$i] = stripslashes($r['plancolor']);
					$this->cclink[$i] = stripslashes($r['cclink']);
					$this->ccunlink[$i] = stripslashes($r['ccunlink']);
					$this->transaction[$i] = stripslashes($r['transaction']);
					$i++;
				}
				$totalFound = mysql_num_rows($sqlResult);
				mysql_free_result($sqlResult);
				return $totalFound;
			}
			return 0;
		}

		public function activateCustomerPlan($userid)
		{
			if (!$this->verifyUniquePlan($userid))
			{
				throw new Exception("Could not upgrade the account because it " .
					"appears you already have this same plan active.");
			}
			$this->deactivateAllCurrentPlans($userid);
			$userid = esc($userid);
			$sql = "INSERT INTO customerplans (userid, planid, startdate,
				lastbilling, nextbilling) VALUES
				('$userid', '" . esc($this->planid[0]) . "', NOW(),
				NOW(), NOW() + INTERVAL 1 MONTH)";
			database($sql);
			$this->recordTransaction($userid);
		}

		public function recordTransaction($userid, $cancel = 0)
		{
			$userid = esc($userid);
			$shortname = esc($this->shortname[0]);
			$planid = esc($this->planid[0]);
			$cancel = esc($cancel);
			$description = "Signed up for $shortname Plan.";
			if ($cancel)
				$description = "Canceled $shortname Plan with code $cancel.";
			// Record the transaction in the database
			$sql = "INSERT INTO transactions (userid, actiondate, actiontype, " .
				"description, amount, itemnumber) VALUES ('$userid', " .
				"NOW(), '2', '$description', " .
				"'0.00', '$planid')";
			database($sql);
		}

		protected function deactivateAllCurrentPlans($userid)
		{
			$userid = esc($userid);
			$sql = "UPDATE customerplans SET scheduledclose = nextbilling " .
				"WHERE userid = '$userid' AND enddate = '0000-00-00'";
			database($sql);
		}

		protected function verifyUniquePlan($userid)
		{
			$userid = esc($userid);
			$planid = esc($this->planid[0]);
			$sql = "SELECT planid FROM customerplans " .
				"WHERE planid = '$planid' AND userid = '$userid' " .
				"AND enddate = '0000-00-00 00:00:00' AND " .
				"scheduledclose = '0000-00-00'";
			$sqlResult = database($sql);
			if ($sqlResult)
			{
				$found = mysql_num_rows($sqlResult);
				mysql_free_result($sqlResult);
				if ($found)
					return false;
			}
			return true;
		}

		public function selectPlanById($planid)
		{
			$planid = esc($planid);
			$sql = "SELECT planid, description, shortname, monthlyprice,
				commission, inventorylimit, promocode, promoexpire, codeexpire,
				hidden, plancolor, cclink, ccunlink, transaction
				FROM planoptions WHERE planid = '$planid'
				AND hidden = 0 LIMIT 1";
			if (!$this->selectPlansFromDatabase($sql))
			{
				throw new Exception("The plan you have selected does not appear to " .
					"be valid.  Please be sure you have selected a valid plan and " .
					"try again.");
			}
		}

		public function selectPrivatePlans($promocode)
		{
			$promocode = esc($promocode);
			$sql = "SELECT planid, description, shortname, monthlyprice,
				commission, inventorylimit, promocode, promoexpire, codeexpire,
				hidden, plancolor, cclink, ccunlink, transaction
				FROM planoptions WHERE promocode = '$promocode'
				AND codeexpire > NOW()";
			if (!$this->selectPlansFromDatabase($sql))
				throw new Exception("The promotional code you entered is not valid
					or has expired.  Please verify your code and try again.");
		}

		public function selectPublicPlans()
		{
			$sql = "SELECT planid, description, shortname, monthlyprice,
				commission, inventorylimit, promocode, promoexpire, codeexpire,
				hidden, plancolor, cclink, ccunlink, transaction
				FROM planoptions WHERE hidden = '0'";
			if (!$this->selectPlansFromDatabase($sql))
				throw new Exception("We are too busy to process your request " . 
					"at this time. Please try again later.");
		}
*/
  }
?>
