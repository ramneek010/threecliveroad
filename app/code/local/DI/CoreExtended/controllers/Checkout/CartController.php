	<?php

require_once('Mage/Checkout/controllers/CartController.php');

class DI_CoreExtended_Checkout_CartController extends Mage_Checkout_CartController
{
    public function addAction()
    {  
       
        $cart   = $this->_getCart();
        $params = $this->getRequest()->getParams();
        
		try {
			
			 $response = array();
            if (isset($params['qty'])) {
                $filter = new Zend_Filter_LocalizedToNormalized(
                    array('locale' => Mage::app()->getLocale()->getLocaleCode())
                );
                $params['qty'] = $filter->filter($params['qty']);
            }
            
            $product = $this->_initProduct();
            $related = $this->getRequest()->getParam('related_product');

            /**
             * Check product availability
             */
            if (!$product) { 
				
			
	           $this->_goBack();       
                return;
            }
			
            $cart->addProduct($product, $params);
            if (!empty($related)) { 
                $cart->addProductsByIds(explode(',', $related));
            }

            $cart->save();

            $this->_getSession()->setCartWasUpdated(true);

            /**
             * @todo remove wishlist observer processAddToCart
             */
            Mage::dispatchEvent('checkout_cart_add_product_complete',
                array('product' => $product, 'request' => $this->getRequest(), 'response' => $this->getResponse())
            );
            
       
				$categoryIds = $product->getCategoryIds();
				foreach($categoryIds as $categoryId) {
				$category = Mage::getModel('catalog/category')->load($categoryId);
				$categoryName[]=  $category->getName(); 
				$categoryIdt[]=  $category->getId(); 
				
				}
		
				



            if (!$this->_getSession()->getNoCartRedirect(true)) {
                if (!$cart->getQuote()->getHasError()){
                    //$message = $this->__('%s HAS BEEN ADDED TO YOUR CART.', Mage::helper('core')->escapeHtml($product->getName()));
                    
                 if($categoryIdt!='' && $categoryIdt['0']==4) {
                    
                    if($categoryName['1']!='') {
						$message = $product->getName()." ".$categoryName['1']." HAS BEEN ADDED TO YOUR BAG";
					}else if($categoryName['0']!=''){
						$message = $product->getName()."".$categoryName['0']."HAS BEEN ADDED TO YOUR BAG";
					}else{
						$message = $product->getName()." HAS BEEN ADDED TO YOUR BAG";
					}
				} else {
					
						$message = $product->getName()." HAS BEEN ADDED TO YOUR BAG";
				}
                    
					//$message = $this->__('YOUR CHOSEN ITEM(S) HAVE BEEN ADDED TO YOUR CART.');
                    //$this->_getSession()->addSuccess($message);
                }
                //$this->_goBack();
                
				$this->loadLayout();
				$response['minicarthead']  = $this->getLayout()->getBlock('minicart_head')->toHtml();
				$response['status'] = 1;
				$response['message'] = $message ;
				$response['items'] = (int) Mage::getSingleton('checkout/cart')->getQuote()->getItemsQty();
				$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response)); 
				
				return;
                
            }
               
              
        } catch (Mage_Core_Exception $e) { 
            if ($this->_getSession()->getUseNotice(true)) {
                $this->_getSession()->addNotice(Mage::helper('core')->escapeHtml($e->getMessage()));
            } else {
                $messages = array_unique(explode("\n", $e->getMessage()));
                foreach ($messages as $message) {
                   // $this->_getSession()->addError(Mage::helper('core')->escapeHtml($message));
                }
            }

         
				$response['status'] = 0; 
				$response['message']=  $e->getMessage();
				$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response)); 
				return; 
				
        } catch (Exception $e) {
          //  $this->_getSession()->addException($e, $this->__('Cannot add the item to shopping cart.'));
           // Mage::logException($e);
            
			$response['status'] = 0; 
			$response['message']=  $e->getMessage();
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response)); 
			return; 
			
            //$this->_goBack();
        }
    }
}
