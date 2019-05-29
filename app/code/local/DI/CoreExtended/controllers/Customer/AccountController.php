<?php

require_once('Mage/Customer/controllers/AccountController.php');

class DI_CoreExtended_Customer_AccountController extends Mage_Customer_AccountController
{    
    public function loginPostAction()
    { 
		$params = $this->getRequest()->getParams();
		
		$session = $this->_getSession();
		$response = array();
		$response['success'] = '0';
		$response['error'] = '';
		if($params['isAjax'] == '1'){
			if ($this->getRequest()->isPost()) {
				$login = $this->getRequest()->getPost('login');
				if (!empty($login['username']) && !empty($login['password'])) {
					try { 
						$session->login($login['username'], $login['password']);
						$response['success'] = '1';
						$this->loadLayout();
						
						$block = $this->getLayout()->getBlock('top.menu');
						$response['topmenu'] = $block->toHtml();
						
						$block = $this->getLayout()->getBlock('top.links');
						$response['link'] = $block->toHtml();
						//if ($session->getCustomer()->getIsJustConfirmed()) {
						//	$this->_welcomeCustomer($session->getCustomer(), true);
						//}
					} catch (Mage_Core_Exception $e) {
						switch ($e->getCode()) {
							case Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED:
								$value = $this->_getHelper('customer')->getEmailConfirmationUrl($login['username']);
								$message = $this->_getHelper('customer')->__('This account is not confirmed. <a href="%s">Click here</a> to resend confirmation email.', $value);
								break;
							case Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD:
								$message = $e->getMessage();
								break;
							default:
								$message = $e->getMessage();
						}
						$response['error'] = $message;
						//$session->addError($message);
						//$session->setUsername($login['username']);
						//$session->setErrorLogin('login');
					} catch (Exception $e) {
						// Mage::logException($e); // PA DSS violation: this exception log can disclose customer password
					}
				} else {
					$response['error'] = $this->__('Login and password are required.');
					//$session->addError($this->__('Login and password are required.'));
					//$session->setErrorLogin('login');
				}
			}
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
			return;	
		}else{
			
			if ($this->getRequest()->isPost()) {
				$login = $this->getRequest()->getPost('login');
				if (!empty($login['username']) && !empty($login['password'])) {
					try {
						$session->login($login['username'], $login['password']);
						if ($session->getCustomer()->getIsJustConfirmed()) {
							$this->_welcomeCustomer($session->getCustomer(), true);
						}
					} catch (Mage_Core_Exception $e) {
						switch ($e->getCode()) {
							case Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED:
								$value = $this->_getHelper('customer')->getEmailConfirmationUrl($login['username']);
								$message = $this->_getHelper('customer')->__('This account is not confirmed. <a href="%s">Click here</a> to resend confirmation email.', $value);
								break;
							case Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD:
								$message = $e->getMessage();
								break;
							default:
								$message = $e->getMessage();
						}
						$session->addError($message);
						$session->setUsername($login['username']);
						$session->setErrorLogin('login');
					} catch (Exception $e) {
						// Mage::logException($e); // PA DSS violation: this exception log can disclose customer password
					}
				} else {
					$session->addError($this->__('Login and password are required.'));
					$session->setErrorLogin('login');
				}
			}
			
			$this->_loginPostRedirect();
		}
    }
    
    /**
     * Create customer account action
     */
    public function createPostAction()
    {
		$params = $this->getRequest()->getParams();  
	

 
        $customer = $this->_getCustomer();
		$response = array();
		$response['success'] = '0';
		$response['error'] = '';
		$response['test'] = "";
		
		if($params['isAjax'] == '1'){
			try {
				$errors = $this->_getCustomerErrors($customer);

				if (empty($errors)) {
					$customer->save();
					//$session->setCustomerAsLoggedIn($customer);
					
					$response['success'] = '1';
					
					$this->_dispatchRegisterSuccess($customer);
					$this->_successProcessRegistration($customer,'1');
										
					
				
					
					$this->loadLayout();
						
					$block = $this->getLayout()->getBlock('top.menu');
					$response['topmenu'] = $block->toHtml();
					//return;
				} else {
					$this->_addSessionError($errors);
				}
			} catch (Mage_Core_Exception $e) {
				//$session->setCustomerFormData($this->getRequest()->getPost());
				if ($e->getCode() === Mage_Customer_Model_Customer::EXCEPTION_EMAIL_EXISTS) {
					$url = $this->_getUrl('customer/account/forgotpassword');
					$message = $this->__('There is already an account with this email address.');
					//$session->setEscapeMessages(false);
				} else {
					$message = $e->getMessage();
				}
				$response['error'] = $message;
				//$session->addError($message);
				//$session->setErrorRegister('create');
			} catch (Exception $e) {
				//$session->setCustomerFormData($this->getRequest()->getPost())
				//	->addException($e, $this->__('Cannot save the customer.'));
					
				//$session->setErrorRegister('create');
			}
			//Mage::getSingleton('core/session')->getMessages(true);
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
			return;
			//$errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
			//$this->_redirectError($errUrl);
		}else{
			try {
				$errors = $this->_getCustomerErrors($customer);

				if (empty($errors)) {
					$customer->save();
					$this->_dispatchRegisterSuccess($customer);
					$this->_successProcessRegistration($customer);
					return;
				} else {
					$this->_addSessionError($errors);
				}
			} catch (Mage_Core_Exception $e) {
				$session->setCustomerFormData($this->getRequest()->getPost());
				if ($e->getCode() === Mage_Customer_Model_Customer::EXCEPTION_EMAIL_EXISTS) {
					$url = $this->_getUrl('customer/account/forgotpassword');
					$message = $this->__('There is already an account with this email address. If you are sure that it is your email address, <a href="%s">click here</a> to get your password and access your account.', $url);
					$session->setEscapeMessages(false);
				} else {
					$message = $e->getMessage();
				}
				$session->addError($message);
				$session->setErrorRegister('create');
			} catch (Exception $e) {
				$session->setCustomerFormData($this->getRequest()->getPost())
					->addException($e, $this->__('Cannot save the customer.'));
					
				$session->setErrorRegister('create');
			}
			$errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
			$this->_redirectError($errUrl);
		}
    }
    
    protected function _welcomeCustomer(Mage_Customer_Model_Customer $customer, $isJustConfirmed = false)
    {
        $this->_getSession()->addSuccess(
            $this->__('', Mage::app()->getStore()->getFrontendName())
        );
        if ($this->_isVatValidationEnabled()) {
            // Show corresponding VAT message to customer
            $configAddressType =  $this->_getHelper('customer/address')->getTaxCalculationAddressType();
            $userPrompt = '';
            switch ($configAddressType) {
                case Mage_Customer_Model_Address_Abstract::TYPE_SHIPPING:
                    $userPrompt = $this->__('If you are a registered VAT customer, please click <a href="%s">here</a> to enter you shipping address for proper VAT calculation',
                        $this->_getUrl('customer/address/edit'));
                    break;
                default:
                    $userPrompt = $this->__('If you are a registered VAT customer, please click <a href="%s">here</a> to enter you billing address for proper VAT calculation',
                        $this->_getUrl('customer/address/edit'));
            }
            $this->_getSession()->addSuccess($userPrompt);
        }

        $customer->sendNewAccountEmail(
            $isJustConfirmed ? 'confirmed' : 'registered',
            '',
            Mage::app()->getStore()->getId()
        );

        $successUrl = $this->_getUrl('*/*/index', array('_secure' => true));
        if ($this->_getSession()->getBeforeAuthUrl()) {
            $successUrl = $this->_getSession()->getBeforeAuthUrl(true);
        }
        return $successUrl;
    }
    
    
    protected function _successProcessRegistration(Mage_Customer_Model_Customer $customer,$isAjax = null)
    {
        $session = $this->_getSession();
        if ($customer->isConfirmationRequired()) {
            /** @var $app Mage_Core_Model_App */
            $app = $this->_getApp();
            /** @var $store  Mage_Core_Model_Store*/
            $store = $app->getStore();
            $customer->sendNewAccountEmail(
                'confirmation',
                $session->getBeforeAuthUrl(),
                $store->getId()
            );
            $customerHelper = $this->_getHelper('customer');
            $session->addSuccess($this->__('Account confirmation is required. Please, check your email for the confirmation link. To resend the confirmation email please <a href="%s">click here</a>.',
                $customerHelper->getEmailConfirmationUrl($customer->getEmail())));
            $url = $this->_getUrl('*/*/index', array('_secure' => true));
        } else {
            $session->setCustomerAsLoggedIn($customer);
            $url = $this->_welcomeCustomer($customer);
        }
        if($isAjax == null){
			$this->_redirectSuccess($url);
			return $this;
		}
    }
    
    
    
      /**
     * Forgot customer password action
     */
    public function forgotPasswordPostAction()
    {
        $email = (string) $this->getRequest()->getPost('email');
       
        
        if ($email) {
            if (!Zend_Validate::is($email, 'EmailAddress')) {
                $this->_getSession()->setForgottenEmail($email);
                $this->_getSession()->addError($this->__('Invalid email address.'));
                $this->_redirect('*/*/forgotpassword'); 
                return;
            }

            /** @var $customer Mage_Customer_Model_Customer */
            $customer = $this->_getModel('customer/customer')
                ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                ->loadByEmail($email);

            if ($customer->getId()) {
                try {
                    $newResetPasswordLinkToken =  $this->_getHelper('customer')->generateResetPasswordLinkToken();
                    $customer->changeResetPasswordLinkToken($newResetPasswordLinkToken);
                    $customer->sendPasswordResetConfirmationEmail();
                    $response['status'] = 1;
                } catch (Exception $exception) {
                   // $this->_getSession()->addError($exception->getMessage());
                  //  $this->_redirect('*/*/forgotpassword');
                   // return;
                    
					$response['msg'] = $exception->getMessage();
					$response['status'] = 0;

                }
            }
           // $this->_getSession()
            //    ->addSuccess( $this->_getHelper('customer')
          //      ->__('If there is an account associated with %s you will receive an email with a link to reset your password.',
          //          $this->_getHelper('customer')->escapeHtml($email)));
           // $this->_redirect('*/*/');
           // return;
            
            $response['msg'] = 'If there is an account associated with '.$email.' you will receive an email with a link to reset your password.';
            $response['status'] = 0;
            
            
        } else {
          //  $this->_getSession()->addError($this->__('Please enter your email.'));
         //   $this->_redirect('*/*/forgotpassword');
           // return;
            $response['msg'] = 'Please enter your email.';
            $response['status'] = 0;
        }
        
        	$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
			return;
        
    }
    
    
    
    
    
    
}
