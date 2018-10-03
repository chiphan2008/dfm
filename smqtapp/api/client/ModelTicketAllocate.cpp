/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */


#include "ModelTicketAllocate.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelTicketAllocate::ModelTicketAllocate(QString* json) {
    init();
    this->fromJson(*json);
}

ModelTicketAllocate::ModelTicketAllocate() {
    init();
}

ModelTicketAllocate::~ModelTicketAllocate() {
    this->cleanup();
}

void
ModelTicketAllocate::init() {
    id = 0L;
    company_id = 0L;
    device_id = 0L;
    ticket_type_id = 0L;
    ticket_price_id = 0L;
    start_number = 0L;
    end_number = 0L;
}

void
ModelTicketAllocate::cleanup() {







}

ModelTicketAllocate*
ModelTicketAllocate::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelTicketAllocate::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&company_id, pJson["company_id"], "qint64", "");
    ::api::setValue(&device_id, pJson["device_id"], "qint64", "");
    ::api::setValue(&ticket_type_id, pJson["ticket_type_id"], "qint64", "");
    ::api::setValue(&ticket_price_id, pJson["ticket_price_id"], "qint64", "");
    ::api::setValue(&start_number, pJson["start_number"], "qint64", "");
    ::api::setValue(&end_number, pJson["end_number"], "qint64", "");
}

QString
ModelTicketAllocate::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelTicketAllocate::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    obj->insert("company_id", QJsonValue(company_id));
    obj->insert("device_id", QJsonValue(device_id));
    obj->insert("ticket_type_id", QJsonValue(ticket_type_id));
    obj->insert("ticket_price_id", QJsonValue(ticket_price_id));
    obj->insert("start_number", QJsonValue(start_number));
    obj->insert("end_number", QJsonValue(end_number));

    return obj;
}

qint64
ModelTicketAllocate::getId() {
    return id;
}
void
ModelTicketAllocate::setId(qint64 id) {
    this->id = id;
}

qint64
ModelTicketAllocate::getCompanyId() {
    return company_id;
}
void
ModelTicketAllocate::setCompanyId(qint64 company_id) {
    this->company_id = company_id;
}

qint64
ModelTicketAllocate::getDeviceId() {
    return device_id;
}
void
ModelTicketAllocate::setDeviceId(qint64 device_id) {
    this->device_id = device_id;
}

qint64
ModelTicketAllocate::getTicketTypeId() {
    return ticket_type_id;
}
void
ModelTicketAllocate::setTicketTypeId(qint64 ticket_type_id) {
    this->ticket_type_id = ticket_type_id;
}

qint64
ModelTicketAllocate::getTicketPriceId() {
    return ticket_price_id;
}
void
ModelTicketAllocate::setTicketPriceId(qint64 ticket_price_id) {
    this->ticket_price_id = ticket_price_id;
}

qint64
ModelTicketAllocate::getStartNumber() {
    return start_number;
}
void
ModelTicketAllocate::setStartNumber(qint64 start_number) {
    this->start_number = start_number;
}

qint64
ModelTicketAllocate::getEndNumber() {
    return end_number;
}
void
ModelTicketAllocate::setEndNumber(qint64 end_number) {
    this->end_number = end_number;
}


}

