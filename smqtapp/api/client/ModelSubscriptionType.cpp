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


#include "ModelSubscriptionType.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelSubscriptionType::ModelSubscriptionType(QString* json) {
    init();
    this->fromJson(*json);
}

ModelSubscriptionType::ModelSubscriptionType() {
    init();
}

ModelSubscriptionType::~ModelSubscriptionType() {
    this->cleanup();
}

void
ModelSubscriptionType::init() {
    id = 0L;
    comany_id = 0L;
    name = new QString("");
    display_name = new QString("");
    duration = 0L;
    price = 0.0f;
    created_at = NULL;
    updated_at = NULL;
}

void
ModelSubscriptionType::cleanup() {


    if(name != nullptr) {
        delete name;
    }
    if(display_name != nullptr) {
        delete display_name;
    }


    if(created_at != nullptr) {
        delete created_at;
    }
    if(updated_at != nullptr) {
        delete updated_at;
    }
}

ModelSubscriptionType*
ModelSubscriptionType::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelSubscriptionType::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&comany_id, pJson["comany_id"], "qint64", "");
    ::api::setValue(&name, pJson["name"], "QString", "QString");
    ::api::setValue(&display_name, pJson["display_name"], "QString", "QString");
    ::api::setValue(&duration, pJson["duration"], "qint64", "");
    ::api::setValue(&price, pJson["price"], "float", "");
    ::api::setValue(&created_at, pJson["created_at"], "QDateTime", "QDateTime");
    ::api::setValue(&updated_at, pJson["updated_at"], "QDateTime", "QDateTime");
}

QString
ModelSubscriptionType::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelSubscriptionType::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    obj->insert("comany_id", QJsonValue(comany_id));
    toJsonValue(QString("name"), name, obj, QString("QString"));
    toJsonValue(QString("display_name"), display_name, obj, QString("QString"));
    obj->insert("duration", QJsonValue(duration));
    obj->insert("price", QJsonValue(price));
    toJsonValue(QString("created_at"), created_at, obj, QString("QDateTime"));
    toJsonValue(QString("updated_at"), updated_at, obj, QString("QDateTime"));

    return obj;
}

qint64
ModelSubscriptionType::getId() {
    return id;
}
void
ModelSubscriptionType::setId(qint64 id) {
    this->id = id;
}

qint64
ModelSubscriptionType::getComanyId() {
    return comany_id;
}
void
ModelSubscriptionType::setComanyId(qint64 comany_id) {
    this->comany_id = comany_id;
}

QString*
ModelSubscriptionType::getName() {
    return name;
}
void
ModelSubscriptionType::setName(QString* name) {
    this->name = name;
}

QString*
ModelSubscriptionType::getDisplayName() {
    return display_name;
}
void
ModelSubscriptionType::setDisplayName(QString* display_name) {
    this->display_name = display_name;
}

qint64
ModelSubscriptionType::getDuration() {
    return duration;
}
void
ModelSubscriptionType::setDuration(qint64 duration) {
    this->duration = duration;
}

float
ModelSubscriptionType::getPrice() {
    return price;
}
void
ModelSubscriptionType::setPrice(float price) {
    this->price = price;
}

QDateTime*
ModelSubscriptionType::getCreatedAt() {
    return created_at;
}
void
ModelSubscriptionType::setCreatedAt(QDateTime* created_at) {
    this->created_at = created_at;
}

QDateTime*
ModelSubscriptionType::getUpdatedAt() {
    return updated_at;
}
void
ModelSubscriptionType::setUpdatedAt(QDateTime* updated_at) {
    this->updated_at = updated_at;
}


}
