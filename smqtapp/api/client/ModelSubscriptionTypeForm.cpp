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


#include "ModelSubscriptionTypeForm.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelSubscriptionTypeForm::ModelSubscriptionTypeForm(QString* json) {
    init();
    this->fromJson(*json);
}

ModelSubscriptionTypeForm::ModelSubscriptionTypeForm() {
    init();
}

ModelSubscriptionTypeForm::~ModelSubscriptionTypeForm() {
    this->cleanup();
}

void
ModelSubscriptionTypeForm::init() {
    id = 0L;
    comany_id = 0L;
    name = new QString("");
    display_name = new QString("");
    duration = 0L;
    price = 0.0f;
}

void
ModelSubscriptionTypeForm::cleanup() {


    if(name != nullptr) {
        delete name;
    }
    if(display_name != nullptr) {
        delete display_name;
    }


}

ModelSubscriptionTypeForm*
ModelSubscriptionTypeForm::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelSubscriptionTypeForm::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&comany_id, pJson["comany_id"], "qint64", "");
    ::api::setValue(&name, pJson["name"], "QString", "QString");
    ::api::setValue(&display_name, pJson["display_name"], "QString", "QString");
    ::api::setValue(&duration, pJson["duration"], "qint64", "");
    ::api::setValue(&price, pJson["price"], "float", "");
}

QString
ModelSubscriptionTypeForm::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelSubscriptionTypeForm::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    obj->insert("comany_id", QJsonValue(comany_id));
    toJsonValue(QString("name"), name, obj, QString("QString"));
    toJsonValue(QString("display_name"), display_name, obj, QString("QString"));
    obj->insert("duration", QJsonValue(duration));
    obj->insert("price", QJsonValue(price));

    return obj;
}

qint64
ModelSubscriptionTypeForm::getId() {
    return id;
}
void
ModelSubscriptionTypeForm::setId(qint64 id) {
    this->id = id;
}

qint64
ModelSubscriptionTypeForm::getComanyId() {
    return comany_id;
}
void
ModelSubscriptionTypeForm::setComanyId(qint64 comany_id) {
    this->comany_id = comany_id;
}

QString*
ModelSubscriptionTypeForm::getName() {
    return name;
}
void
ModelSubscriptionTypeForm::setName(QString* name) {
    this->name = name;
}

QString*
ModelSubscriptionTypeForm::getDisplayName() {
    return display_name;
}
void
ModelSubscriptionTypeForm::setDisplayName(QString* display_name) {
    this->display_name = display_name;
}

qint64
ModelSubscriptionTypeForm::getDuration() {
    return duration;
}
void
ModelSubscriptionTypeForm::setDuration(qint64 duration) {
    this->duration = duration;
}

float
ModelSubscriptionTypeForm::getPrice() {
    return price;
}
void
ModelSubscriptionTypeForm::setPrice(float price) {
    this->price = price;
}


}
