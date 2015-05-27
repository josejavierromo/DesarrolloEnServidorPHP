<?php

namespace app\models\CorePyme\Security;

use app\models\Common\Enum;

abstract class SecurityEntityTypes extends Enum{
	const user = 0;
	const group = 1;
	const role = 2;
}



