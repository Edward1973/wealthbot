<?php
/**
 * Created by PhpStorm.
 * User: amalyuhin
 * Date: 28.11.13
 * Time: 16:34
 */

namespace Wealthbot\SignatureBundle\Model\TabsConfiguration;


use Wealthbot\ClientBundle\Entity\Distribution;
use Wealthbot\SignatureBundle\Model\SignableInterface;
use Wealthbot\SignatureBundle\Model\Tab\RadioGroupTab;
use Wealthbot\SignatureBundle\Model\Tab\TextTab;
use Wealthbot\SignatureBundle\Model\TabCollection;

class CheckRequest extends AbstractTabsConfiguration
{
    /** @var \Wealthbot\SignatureBundle\Model\SignableInterface */
    private $signableObject;

    public function __construct(SignableInterface $object)
    {
        $this->signableObject = $object;
    }

    /**
     * Generate collection of tabs
     *
     * @return TabCollection
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function generate()
    {
        if (!($this->signableObject instanceof Distribution) || !$this->signableObject->isOneTime()) {
            throw new \InvalidArgumentException('Signable object must be one-time distribution.');
        }

        if ($this->signableObject->getTransferMethod() !== Distribution::TRANSFER_METHOD_RECEIVE_CHECK) {
            throw new \RuntimeException('Invalid transfer method for one-time distribution.');
        }

        $clientAccount = $this->signableObject->getClientAccount();
        $client = $clientAccount ? $clientAccount->getClient() : null;
        $companyInformation = $client ? $client->getRiaCompanyInformation() : null;

        $tabs = array();

        $advisorCode = new TextTab();
        $advisorCode->setTabLabel('advisor#')->setValue($this->getAdvisorCode($companyInformation));
        $tabs[] = $advisorCode;

        $accountNumber = new TextTab();
        $accountNumber->setTabLabel('account#')->setValue($clientAccount ? $clientAccount->getAccountNumber() : '');
        $tabs[] = $accountNumber;

        $tabs += $this->accountInformationSection();
        $tabs += $this->paymentDetailsSection();
        $tabs += $this->deliveryDetailsSection();
        $tabs += $this->frequencySection();
        $tabs += $this->periodicDetailsSection();

        return new TabCollection($tabs);
    }

    /**
     * Generate account information section tabs
     *
     * @return array
     */
    public function accountInformationSection()
    {
        $bankInformation = $this->signableObject->getBankInformation();
        $tabs = array();

        $accountTitleTab = new TextTab();
        $accountTitleTab->setTabLabel('account_title')->setValue($bankInformation->getAccountTitle());
        $tabs[] = $accountTitleTab;

        return $tabs;
    }

    /**
     * Generate payment details section tabs
     *
     * @return array
     */
    public function paymentDetailsSection()
    {
        $clientAccount = $this->signableObject->getClientAccount();
        $client = $clientAccount->getClient();
        $riaCompanyInfo = $client->getRiaCompanyInformation();
        $tabs = array();

        $paymentTypeTab = new RadioGroupTab();
        $paymentTypeTab->setGroupName('payment_type')->setValue('specific_amount')->setSelected(true);
        $tabs[] = $paymentTypeTab;

        $amountTab = new TextTab();
        $amountTab->setTabLabel('specific_amount_value')->setValue($this->signableObject->getAmount());
        $tabs[] = $amountTab;

        $advisorFirmTab = new TextTab();
        $advisorFirmTab->setTabLabel('advisor_firm_name')->setValue($riaCompanyInfo->getName());
        $tabs[] = $advisorFirmTab;

        return $tabs;
    }

    /**
     * Generate delivery details section tabs
     *
     * @return array
     */
    public function deliveryDetailsSection()
    {
        $clientAccount = $this->signableObject->getClientAccount();
        $owner = $clientAccount->getPrimaryApplicant();
        $tabs = array();

        $deliveryDetailsTab = new RadioGroupTab();
        $deliveryDetailsTab->setGroupName('delivery_details')->setValue('account_owner')->setSelected(true);
        $tabs[] = $deliveryDetailsTab;

        $payeeNameTab = new TextTab();
        $payeeNameTab->setTabLabel('delivery_payee_name')->setValue($owner->getFullName());
        $tabs[] = $payeeNameTab;

        $addressTab = new TextTab();
        $addressTab->setTabLabel('delivery_address')->setValue($owner->getStreet());
        $tabs[] = $addressTab;

        $cityTab = new TextTab();
        $cityTab->setTabLabel('delivery_city')->setValue($owner->getCity());
        $tabs[] = $cityTab;

        $stateTab = new TextTab();
        $stateTab->setTabLabel('delivery_state')->setValue($owner->getState()->getName());
        $tabs[] = $stateTab;

        $zipTab = new TextTab();
        $zipTab->setTabLabel('delivery_zip_code')->setValue($owner->getZip());
        $tabs[] = $zipTab;

        return $tabs;
    }

    /**
     * Generate frequency section tabs
     *
     * @return array
     */
    public function frequencySection()
    {
        $tabs = array();

        $frequencyTab = new RadioGroupTab();
        $frequencyTab->setGroupName('frequency')->setValue('one_time_request');
        $tabs[] = $frequencyTab;

        return $tabs;
    }

    /**
     * Generate periodic details section tabs
     *
     * @return array
     */
    public function periodicDetailsSection()
    {
        $tabs = array();

        $periodicDetailsTypeTab = new RadioGroupTab();
        $periodicDetailsTypeTab->setGroupName('periodic_details_type')->setValue('new_request')->setSelected(true);
        $tabs[] = $periodicDetailsTypeTab;

        return $tabs;
    }

} 