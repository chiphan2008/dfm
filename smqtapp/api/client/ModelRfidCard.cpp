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


#include "ModelRfidCard.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelRfidCard::ModelRfidCard(QString* json) {
    init();
    this->fromJson(*json);
}

ModelRfidCard::ModelRfidCard() {
    init();
}

ModelRfidCard::~ModelRfidCard() {
    this->cleanup();
}

void
ModelRfidCard::init() {
    id = 0L;
    rfid = new QString("");
    barcode = new QString("");
    usage_type = new QString("");
    target_id = 0L;
    created_at = NULL;
    updated_at = NULL;
}

void
ModelRfidCard::cleanup() {

    if(rfid != nullptr) {
        delete rfid;
    }
    if(barcode != nullptr) {
        delete barcode;
    }
    if(usage_type != nullptr) {
        delete usage_type;
    }

    if(created_at != nullptr) {
        delete created_at;
    }
    if(updated_at != nullptr) {
        delete updated_at;
    }
}

ModelRfidCard*
ModelRfidCard::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelRfidCard::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&rfid, pJson["rfid"], "QString", "QString");
    ::api::setValue(&barcode, pJson["barcode"], "QString", "QString");
    ::api::setValue(&usage_type, pJson["usage_type"], "QString", "QString");
    ::api::setValue(&target_id, pJson["target_id"], "qint64", "");
    ::api::setValue(&created_at, pJson["created_at"], "QDateTime", "QDateTime");
    ::api::setValue(&updated_at, pJson["updated_at"], "QDateTime", "QDateTime");
}

QString
ModelRfidCard::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelRfidCard::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    toJsonValue(QString("rfid"), rfid, obj, QString("QString"));
    toJsonValue(QString("barcode"), barcode, obj, QString("QString"));
    toJsonValue(QString("usage_type"), usage_type, obj, QString("QString"));
    obj->insert("target_id", QJsonValue(target_id));
    toJsonValue(QString("created_at"), created_at, obj, QString("QDateTime"));
    toJsonValue(QString("updated_at"), updated_at, obj, QString("QDateTime"));

    return obj;
}

qint64
ModelRfidCard::getId() {
    return id;
}
void
ModelRfidCard::setId(qint64 id) {
    this->id = id;
}

QString*
ModelRfidCard::getRfid() {
    return rfid;
}
void
ModelRfidCard::setRfid(QString* rfid) {
    this->rfid = rfid;
}

QString*
ModelRfidCard::getBarcode() {
    return barcode;
}
void
ModelRfidCard::setBarcode(QString* barcode) {
    this->barcode = barcode;
}

QString*
ModelRfidCard::getUsageType() {
    return usage_type;
}
void
ModelRfidCard::setUsageType(QString* usage_type) {
    this->usage_type = usage_type;
}

qint64
ModelRfidCard::getTargetId() {
    return target_id;
}
void
ModelRfidCard::setTargetId(qint64 target_id) {
    this->target_id = target_id;
}

QDateTime*
ModelRfidCard::getCreatedAt() {
    return created_at;
}
void
ModelRfidCard::setCreatedAt(QDateTime* created_at) {
    this->created_at = created_at;
}

QDateTime*
ModelRfidCard::getUpdatedAt() {
    return updated_at;
}
void
ModelRfidCard::setUpdatedAt(QDateTime* updated_at) {
    this->updated_at = updated_at;
}


}

