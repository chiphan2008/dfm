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


#include "ModelTicketTypeForm.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelTicketTypeForm::ModelTicketTypeForm(QString* json) {
    init();
    this->fromJson(*json);
}

ModelTicketTypeForm::ModelTicketTypeForm() {
    init();
}

ModelTicketTypeForm::~ModelTicketTypeForm() {
    this->cleanup();
}

void
ModelTicketTypeForm::init() {
    id = 0L;
    comany_id = 0L;
    name = new QString("");
    description = new QString("");
    order_code = new QString("");
    sign = new QString("");
    sign_form = new QString("");
    price = 0.0f;
}

void
ModelTicketTypeForm::cleanup() {


    if(name != nullptr) {
        delete name;
    }
    if(description != nullptr) {
        delete description;
    }
    if(order_code != nullptr) {
        delete order_code;
    }
    if(sign != nullptr) {
        delete sign;
    }
    if(sign_form != nullptr) {
        delete sign_form;
    }

}

ModelTicketTypeForm*
ModelTicketTypeForm::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelTicketTypeForm::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&comany_id, pJson["comany_id"], "qint64", "");
    ::api::setValue(&name, pJson["name"], "QString", "QString");
    ::api::setValue(&description, pJson["description"], "QString", "QString");
    ::api::setValue(&order_code, pJson["order_code"], "QString", "QString");
    ::api::setValue(&sign, pJson["sign"], "QString", "QString");
    ::api::setValue(&sign_form, pJson["sign_form"], "QString", "QString");
    ::api::setValue(&price, pJson["price"], "float", "");
}

QString
ModelTicketTypeForm::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelTicketTypeForm::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    obj->insert("comany_id", QJsonValue(comany_id));
    toJsonValue(QString("name"), name, obj, QString("QString"));
    toJsonValue(QString("description"), description, obj, QString("QString"));
    toJsonValue(QString("order_code"), order_code, obj, QString("QString"));
    toJsonValue(QString("sign"), sign, obj, QString("QString"));
    toJsonValue(QString("sign_form"), sign_form, obj, QString("QString"));
    obj->insert("price", QJsonValue(price));

    return obj;
}

qint64
ModelTicketTypeForm::getId() {
    return id;
}
void
ModelTicketTypeForm::setId(qint64 id) {
    this->id = id;
}

qint64
ModelTicketTypeForm::getComanyId() {
    return comany_id;
}
void
ModelTicketTypeForm::setComanyId(qint64 comany_id) {
    this->comany_id = comany_id;
}

QString*
ModelTicketTypeForm::getName() {
    return name;
}
void
ModelTicketTypeForm::setName(QString* name) {
    this->name = name;
}

QString*
ModelTicketTypeForm::getDescription() {
    return description;
}
void
ModelTicketTypeForm::setDescription(QString* description) {
    this->description = description;
}

QString*
ModelTicketTypeForm::getOrderCode() {
    return order_code;
}
void
ModelTicketTypeForm::setOrderCode(QString* order_code) {
    this->order_code = order_code;
}

QString*
ModelTicketTypeForm::getSign() {
    return sign;
}
void
ModelTicketTypeForm::setSign(QString* sign) {
    this->sign = sign;
}

QString*
ModelTicketTypeForm::getSignForm() {
    return sign_form;
}
void
ModelTicketTypeForm::setSignForm(QString* sign_form) {
    this->sign_form = sign_form;
}

float
ModelTicketTypeForm::getPrice() {
    return price;
}
void
ModelTicketTypeForm::setPrice(float price) {
    this->price = price;
}


}

