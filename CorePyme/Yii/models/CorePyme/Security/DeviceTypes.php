<?php

namespace app\models\CorePyme\Security;

use app\models\Common\Enum;

abstract class DeviceTypes extends Enum{
	const web = 0;
	const app = 1;
}