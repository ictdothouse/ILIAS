<?php
require_once './Services/WorkflowEngine/classes/workflows/class.ilBaseWorkflow.php';
require_once './Services/WorkflowEngine/classes/nodes/class.ilBasicNode.php';
require_once './Services/WorkflowEngine/classes/nodes/class.ilCaseNode.php';
require_once './Services/WorkflowEngine/classes/emitters/class.ilActivationEmitter.php';
require_once './Services/WorkflowEngine/classes/detectors/class.ilSimpleDetector.php';

		class ExclusiveGateway_Fork_Simple extends ilBaseWorkflow
		{
		
			public static $startEventRequired = false;
		
			public function __construct()
			{
		
			$_v_StartEvent_1 = new ilBasicNode($this);
			$this->addNode($_v_StartEvent_1);
			$_v_StartEvent_1->setName('$_v_StartEvent_1');
		
			$this->setStartNode($_v_StartEvent_1);
			
			$_v_ExclusiveGateway_1 = new ilCaseNode($this);
			$_v_ExclusiveGateway_1->setName('$_v_ExclusiveGateway_1');
			$_v_ExclusiveGateway_1->setIsExclusiveJoin(true);
			$this->addNode($_v_ExclusiveGateway_1);
		
			$_v_IntermediateCatchEvent_2 = new ilBasicNode($this);
			$this->addNode($_v_IntermediateCatchEvent_2);
			$_v_IntermediateCatchEvent_2->setName('$_v_IntermediateCatchEvent_2');
		
			$_v_IntermediateCatchEvent_1 = new ilBasicNode($this);
			$this->addNode($_v_IntermediateCatchEvent_1);
			$_v_IntermediateCatchEvent_1->setName('$_v_IntermediateCatchEvent_1');
		
			$_v_ParallelGateway_1 = new ilBasicNode($this);
			$_v_ParallelGateway_1->setName('$_v_ParallelGateway_1');
			$this->addNode($_v_ParallelGateway_1);
		
			$_v_EndEvent_3 = new ilBasicNode($this);
			$this->addNode($_v_EndEvent_3);
			$_v_EndEvent_3->setName('$_v_EndEvent_3');
		
			$_v_ExclusiveGateway_1_detector = new ilSimpleDetector($_v_ExclusiveGateway_1);
			$_v_ExclusiveGateway_1_detector->setName('$_v_ExclusiveGateway_1_detector');
			$_v_ExclusiveGateway_1_detector->setSourceNode($_v_StartEvent_1);
			$_v_ExclusiveGateway_1->addDetector($_v_ExclusiveGateway_1_detector);
			$_v_StartEvent_1_emitter = new ilActivationEmitter($_v_StartEvent_1);
			$_v_StartEvent_1_emitter->setName('$_v_StartEvent_1_emitter');
			$_v_StartEvent_1_emitter->setTargetDetector($_v_ExclusiveGateway_1_detector);
			$_v_StartEvent_1->addEmitter($_v_StartEvent_1_emitter);
		
			$_v_IntermediateCatchEvent_1_detector = new ilSimpleDetector($_v_IntermediateCatchEvent_1);
			$_v_IntermediateCatchEvent_1_detector->setName('$_v_IntermediateCatchEvent_1_detector');
			$_v_IntermediateCatchEvent_1_detector->setSourceNode($_v_ExclusiveGateway_1);
			$_v_IntermediateCatchEvent_1->addDetector($_v_IntermediateCatchEvent_1_detector);
			$_v_ExclusiveGateway_1_emitter = new ilActivationEmitter($_v_ExclusiveGateway_1);
			$_v_ExclusiveGateway_1_emitter->setName('$_v_ExclusiveGateway_1_emitter');
			$_v_ExclusiveGateway_1_emitter->setTargetDetector($_v_IntermediateCatchEvent_1_detector);
			$_v_ExclusiveGateway_1->addEmitter($_v_ExclusiveGateway_1_emitter);
		
			$_v_IntermediateCatchEvent_2_detector = new ilSimpleDetector($_v_IntermediateCatchEvent_2);
			$_v_IntermediateCatchEvent_2_detector->setName('$_v_IntermediateCatchEvent_2_detector');
			$_v_IntermediateCatchEvent_2_detector->setSourceNode($_v_ExclusiveGateway_1);
			$_v_IntermediateCatchEvent_2->addDetector($_v_IntermediateCatchEvent_2_detector);
			$_v_ExclusiveGateway_1_emitter = new ilActivationEmitter($_v_ExclusiveGateway_1);
			$_v_ExclusiveGateway_1_emitter->setName('$_v_ExclusiveGateway_1_emitter');
			$_v_ExclusiveGateway_1_emitter->setTargetDetector($_v_IntermediateCatchEvent_2_detector);
			$_v_ExclusiveGateway_1->addEmitter($_v_ExclusiveGateway_1_emitter);
		
			$_v_ParallelGateway_1_detector = new ilSimpleDetector($_v_ParallelGateway_1);
			$_v_ParallelGateway_1_detector->setName('$_v_ParallelGateway_1_detector');
			$_v_ParallelGateway_1_detector->setSourceNode($_v_IntermediateCatchEvent_1);
			$_v_ParallelGateway_1->addDetector($_v_ParallelGateway_1_detector);
			$_v_IntermediateCatchEvent_1_emitter = new ilActivationEmitter($_v_IntermediateCatchEvent_1);
			$_v_IntermediateCatchEvent_1_emitter->setName('$_v_IntermediateCatchEvent_1_emitter');
			$_v_IntermediateCatchEvent_1_emitter->setTargetDetector($_v_ParallelGateway_1_detector);
			$_v_IntermediateCatchEvent_1->addEmitter($_v_IntermediateCatchEvent_1_emitter);
		
			$_v_ParallelGateway_1_detector = new ilSimpleDetector($_v_ParallelGateway_1);
			$_v_ParallelGateway_1_detector->setName('$_v_ParallelGateway_1_detector');
			$_v_ParallelGateway_1_detector->setSourceNode($_v_IntermediateCatchEvent_2);
			$_v_ParallelGateway_1->addDetector($_v_ParallelGateway_1_detector);
			$_v_IntermediateCatchEvent_2_emitter = new ilActivationEmitter($_v_IntermediateCatchEvent_2);
			$_v_IntermediateCatchEvent_2_emitter->setName('$_v_IntermediateCatchEvent_2_emitter');
			$_v_IntermediateCatchEvent_2_emitter->setTargetDetector($_v_ParallelGateway_1_detector);
			$_v_IntermediateCatchEvent_2->addEmitter($_v_IntermediateCatchEvent_2_emitter);
		
			$_v_EndEvent_3_detector = new ilSimpleDetector($_v_EndEvent_3);
			$_v_EndEvent_3_detector->setName('$_v_EndEvent_3_detector');
			$_v_EndEvent_3_detector->setSourceNode($_v_ParallelGateway_1);
			$_v_EndEvent_3->addDetector($_v_EndEvent_3_detector);
			$_v_ParallelGateway_1_emitter = new ilActivationEmitter($_v_ParallelGateway_1);
			$_v_ParallelGateway_1_emitter->setName('$_v_ParallelGateway_1_emitter');
			$_v_ParallelGateway_1_emitter->setTargetDetector($_v_EndEvent_3_detector);
			$_v_ParallelGateway_1->addEmitter($_v_ParallelGateway_1_emitter);
		
			}
		}
		
?>